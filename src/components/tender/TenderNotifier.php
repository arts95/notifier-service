<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

use app\entity\tender\TenderEntity;
use app\services\TenderService;


/**
 * Class TenderNotifier
 */
class TenderNotifier extends \app\components\base\Notifier
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
    }

    public static function getNotifier(TenderEntity $oTender, TenderEntity $nTender): TenderNotifier
    {
        return new TenderNotifier($oTender, $nTender);
    }

    protected function terminate()
    {
        if (in_array($this->nPurchase->getStatus(), ['cancelled', 'unsuccessful']) && $this->oPurchase->getStatus() != $this->nPurchase->getStatus()) {
            /** @todo get bidders and notify */
            /** $bidders = $this->service->getBidders(); */
            $this->notifyRequesterAboutTerminateStatus();
        } elseif (!empty($this->nPurchase->getLots())) {
            foreach ($this->nPurchase->getLots() as $lot) {
                if (in_array($lot->getStatus(), ['cancelled', 'unsuccessful'])) {
                    $check = $this->getEntityInfo($this->oPurchase->getLots(), $lot->getId());
                    if ($check->entity ? $lot->getStatus() == $check->entity->getStatus() : !$check->new) continue;
                    /** $bidders = $this->service->getBidders($lotID); */
                    /** @todo get bidders and notify */
                    $this->notifyRequesterAboutTerminateStatus($lot->getId());
                }
            }
        }
    }

    protected function notifyRequesterAboutTerminateStatus($lotID = null)
    {
        $requesters = $this->service->getRequesters();
        $ids = $this->oPurchase->getComplaintsQuestionsId($lotID);
        if ($ids) {
            foreach ($requesters as $requester) {
                /** @todo notify */
            }
        }
    }

    protected function preQualificationResult()
    {
        if ($this->nPurchase->getStatus() != 'active.pre-qualification.stand-still') return;
        if ($this->nPurchase->getStatus() == $this->oPurchase->getStatus()) return;
        if (empty($this->nPurchase->getQualifications())) return;

        foreach ($this->nPurchase->getQualifications() as $qualification) {
            if ($qualification->getStatus() == 'cancelled' || !$qualification->getBidID()) continue;
            $bid = $this->service->getBidderByID($qualification->getBidID());
            if ($bid) {
                /** @todo notify */
            }
        }
    }

    protected function qualificationResult()
    {
        /** @todo check purchase status */
        if (empty($this->nPurchase->getAwards())) return;
        foreach ($this->nPurchase->getAwards() as $award) {
            $check = $this->getEntityInfo($this->oPurchase->getAwards(), $award->getId());
            if ($check->entity ? $check->entity->getStatus() == $award->getStatus() : !$check->new) continue;
            $bidder = $this->service->getBidderByID($award->getBidId());
            /** @todo notify $bidder */
        }
    }

    protected function complaints()
    {
        /** @todo check purchase status */
        $requesters = $this->service->getRequesters();
        if (empty($requesters)) return;
        foreach ($requesters as $requester) {
            if (empty($requester->getComplaints())) continue;
            foreach ($requester->getComplaints() as $complaint) {
                $this->purchaseComplaints($complaint->getId());
                $this->qualificationComplaints($complaint->getId());
                $this->awardComplaints($complaint->getId());
            }
        }
    }

    protected function purchaseComplaints(string $complaintID)
    {
        if (empty($this->nPurchase->getComplaints())) return;
        foreach ($this->nPurchase->getComplaints() as $complaint) {
            if ($complaint->getId() != $complaintID) continue;
            $check = $this->getEntityInfo($this->oPurchase->getComplaints(), $complaint->getId());
            if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
            /** @todo check status */
            if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken', 'answered'])) {
                /** @todo notify requester and organizer */
            } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                /** @todo notify organizer about new complaint and requester about create */
            }
        }
    }

    protected function qualificationComplaints(string $complaintID)
    {
        if (empty($this->nPurchase->getQualifications())) return;

        foreach ($this->nPurchase->getQualifications() as $qualification) {
            if (empty($qualification->getComplaints())) continue;
            foreach ($qualification->getComplaints() as $complaint) {
                if ($complaint->getId() != $complaintID) continue;
                $check = $this->getEntityInfo($this->oPurchase->getComplaintsByQualification($qualification->getId()), $complaint->getId());
                if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
                /** @todo check status */
                if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken'])) {
                    /** @todo notify requester and organizer */
                } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                    /** @todo notify organizer about new complaint and requester about create */
                }
            }
        }
    }

    protected function awardComplaints(string $complaintID)
    {
        if (empty($this->nPurchase->getAwards())) return;
        foreach ($this->nPurchase->getAwards() as $award) {
            if (empty($award->getComplaints())) continue;
            foreach ($award->getComplaints() as $complaint) {
                if ($complaint->getId() != $complaintID) continue;
                $check = $this->getEntityInfo($this->oPurchase->getComplaintsByAward($award->getId()), $complaint->getId());
                if ($check->entity ? $check->entity->getStatus() == $complaint->getStatus() : !$check->new) continue;
                /** @todo check status */
                if (in_array($complaint->getStatus(), ['accepted', 'satisfied', 'declined', 'invalid', 'mistaken', 'resolved', 'stopped', 'stopping', 'answered'])) {
                    /** @todo notify requester and organizer */
                } elseif (in_array($complaint->getStatus(), ['claim', 'pending'])) {
                    /** @todo notify organizer about new complaint and requester about create */
                }
            }
        }
    }

    protected function secondStage()
    {
        if ($this->nPurchase->getStage2TenderID()) {
            /** @todo notify about new stage */
        }
    }

}