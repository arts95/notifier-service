<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\components\tender;

use app\components\base\Notifier;
use app\entity\service\EventEntity;
use app\entity\tender\lot\LotEntity;
use app\entity\tender\TenderEntity;
use app\services\TenderService;


/**
 * Class TenderNotifier
 */
class TenderNotifier extends Notifier
{

    /**
     * TenderNotifier constructor.
     *
     * @param TenderEntity $oTender
     * @param TenderEntity $nTender
     */
    public function __construct(TenderEntity $oTender, TenderEntity $nTender)
    {
        $this->oPurchase = $oTender;
        $this->nPurchase = $nTender;
        $this->service = new TenderService($this->nPurchase->getId());
        $this->events = [];
    }

    public static function getNotifier(TenderEntity $oTender, TenderEntity $nTender): TenderNotifier
    {
        return new TenderNotifier($oTender, $nTender);
    }

    public function analyze(): void
    {
        $this->events += $this->checkTerminateStatus();
        $this->events += $this->questions();
        $this->events += $this->checkAllComplaints();
        $this->events += $this->checkSecondStage();
        $this->events += $this->checkPreQualificationResult();
        $this->events += $this->checkQualificationResult();
    }

    /**
     * @return EventEntity[]
     */
    protected function checkTerminateStatus(): array
    {
        $events = [];
        if (in_array($this->nPurchase->getStatus(), ['cancelled', 'unsuccessful']) && $this->oPurchase->getStatus() != $this->nPurchase->getStatus()) {
            $events += $this->notifyRequesterAboutTerminateStatus();
            $events += $this->notifyBiddersAboutTerminateStatus();
        } elseif (!empty($this->nPurchase->getLots())) {
            foreach ($this->nPurchase->getLots() as $lot) {
                if (in_array($lot->getStatus(), ['cancelled', 'unsuccessful'])) {
                    $check = $this->getEntityInfo($this->oPurchase->getLots(), $lot->getId());
                    if ($check->entity ? $lot->getStatus() == $check->entity->getStatus() : !$check->new) continue;
                    $events += $this->notifyRequesterAboutTerminateStatus($lot);
                    $events += $this->notifyBiddersAboutTerminateStatus($lot);
                }
            }
        }
        return $events;
    }

    /**
     * @todo set id of event
     * @param LotEntity|null $lot
     * @return EventEntity[]
     */
    protected function notifyRequesterAboutTerminateStatus(?LotEntity $lot = null): array
    {
        $events = [];
        $requesters = $this->service->getRequesters();
        $ids = $this->oPurchase->getComplaintsQuestionsId($lot);
        if ($ids) {
            foreach ($requesters as $requester) {
                $events[] = new EventEntity('', $requester, [
                    'purchase' => $this->nPurchase,
                    'lot' => $lot,
                ]);
            }
        }
        return $events;
    }

    /**
     * @todo set id of event
     * @param LotEntity|null $lot
     * @return array
     */
    protected function notifyBiddersAboutTerminateStatus(?LotEntity $lot = null): array
    {
        $bidders = $this->service->getBidders($lot ? $lot->getId() : null);
        if (empty($bidders)) return [];
        $events = [];
        foreach ($bidders as $bidder) {
            $events[] = new EventEntity('', $bidder, [
                'purchase' => $this->nPurchase,
                'lot' => $lot,
            ]);
        }
        return $events;
    }

    protected function checkAllComplaints()
    {
        /** @todo check purchase status in all functions */
        $this->checkPurchaseComplaints();
        $this->checkQualificationComplaints();
        $this->checkAwardComplaints();
    }

    /**
     * @todo set id of event
     * @return EventEntity[]
     */
    protected function checkPurchaseComplaints(): array
    {
        if (empty($this->nPurchase->getComplaints())) return [];
        $events = [];
        foreach ($this->nPurchase->getComplaints() as $complaint) {
            $check = $this->getEntityInfo($this->oPurchase->getComplaints(), $complaint->getId());
            if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
            /** @todo check status */
            if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken'])) {
                /** @todo set id of event */
                if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                    $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                }
                $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                    'purchase' => $this->nPurchase,
                    'complaint' => $complaint,
                ]);
            } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                /** @todo set id of event */
                if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                    $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                }
                $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                    'purchase' => $this->nPurchase,
                    'complaint' => $complaint,
                ]);
            } elseif (in_array($complaint->getStatus(), ['answered'])) {
                /** @todo set id of event */
                if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                    $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                }
            }
        }
        return $events;
    }

    /**
     * @return EventEntity[]
     */
    protected function checkQualificationComplaints(): array
    {
        if (empty($this->nPurchase->getQualifications())) return [];
        $events = [];
        foreach ($this->nPurchase->getQualifications() as $qualification) {
            if (empty($qualification->getComplaints())) continue;
            foreach ($qualification->getComplaints() as $complaint) {
                $check = $this->getEntityInfo($this->oPurchase->getComplaintsByQualification($qualification->getId()), $complaint->getId());
                if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
                /** @todo check status */
                if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                    $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                    $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                } elseif (in_array($complaint->getStatus(), ['answered'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                }
            }
        }
        return $events;
    }

    /**
     * @return EventEntity[]
     */
    protected function checkAwardComplaints(): array
    {
        if (empty($this->nPurchase->getAwards())) return [];
        $events = [];
        foreach ($this->nPurchase->getAwards() as $award) {
            if (empty($award->getComplaints())) continue;
            foreach ($award->getComplaints() as $complaint) {
                $check = $this->getEntityInfo($this->oPurchase->getComplaintsByAward($award->getId()), $complaint->getId());
                if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
                /** @todo check status */
                if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken', 'resolved', 'stopped', 'stopping'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                    $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                    $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                        'purchase' => $this->nPurchase,
                        'complaint' => $complaint,
                    ]);
                } elseif (in_array($complaint->getStatus(), ['answered'])) {
                    /** @todo set id of event */
                    if ($this->service->getRequesterByComplaintId($complaint->getId())) {
                        $events[] = new EventEntity('', $this->service->getRequesterByComplaintId($complaint->getId()), [
                            'purchase' => $this->nPurchase,
                            'complaint' => $complaint,
                        ]);
                    }
                }
            }
        }
        return $events;
    }

    /**
     * @return EventEntity[]
     */
    protected function checkSecondStage(): array
    {
        if (!$this->nPurchase->getStage2TenderID()) return [];
        if (empty($this->service->getActiveBidders())) return [];
        $events = [];
        foreach ($this->service->getActiveBidders() as $bidder) {
            /** @todo set id of event */
            $events[] = new EventEntity('', $bidder, [
                'purchase' => $this->nPurchase,
            ]);
        }
        /** @todo set id of event */
        $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
            'purchase' => $this->nPurchase,
        ]);
        return $events;
    }


    /**
     * @return EventEntity[]
     */
    protected function checkPreQualificationResult(): array
    {
        if ($this->nPurchase->getStatus() != 'active.pre-qualification.stand-still') return [];
        if ($this->nPurchase->getStatus() == $this->oPurchase->getStatus()) return [];
        if (empty($this->nPurchase->getQualifications())) return [];
        $events = [];
        foreach ($this->nPurchase->getQualifications() as $qualification) {
            if ($qualification->getStatus() == 'cancelled' || !$qualification->getBidID()) continue;
            $bidder = $this->service->getBidderByID($qualification->getBidID());
            if ($bidder) {
                /** @todo set id of event */
                $events[] = new EventEntity('', $bidder, [
                    'purchase' => $this->nPurchase,
                    'qualification' => $qualification,
                ]);
            }
        }
        return $events;
    }

    /**
     * @return EventEntity[]
     */
    protected function checkQualificationResult(): array
    {
        /** @todo check purchase status */
        if (empty($this->nPurchase->getAwards())) return [];
        $events = [];
        foreach ($this->nPurchase->getAwards() as $award) {
            $check = $this->getEntityInfo($this->oPurchase->getAwards(), $award->getId());
            if ($check->entity ? $check->entity->getStatus() == $award->getStatus() : !$check->new) continue;
            $bidder = $this->service->getBidderByID($award->getBidId());
            /** @todo set id of event */
            $events[] = new EventEntity('', $bidder, [
                'purchase' => $this->nPurchase,
                'award' => $award,
            ]);
        }
        return $events;
    }

}