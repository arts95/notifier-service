<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\auction;

use app\components\base\Notifier;
use app\entity\auction\AuctionEntity;
use app\entity\base\AwardEntity;
use app\entity\base\ContractEntity;
use app\entity\service\EventEntity;
use app\services\AuctionService;

/**
 * Class AuctionNotifier
 *
 * @package app\components\auction
 */
class AuctionNotifier extends Notifier
{
    /**
     * AuctionNotifier constructor.
     *
     * @param AuctionEntity $oAuction
     * @param AuctionEntity $nAuction
     */
    public function __construct(AuctionEntity $oAuction, AuctionEntity $nAuction)
    {
        $this->oPurchase = $oAuction;
        $this->nPurchase = $nAuction;
        $this->service = new AuctionService([
            'type' => 'auction',
            'purchaseID' => $this->nPurchase->getId(),
        ]);
    }

    public static function getNotifier(AuctionEntity $oAuction, AuctionEntity $nAuction): AuctionNotifier
    {
        return new AuctionNotifier($oAuction, $nAuction);
    }

    public function analyze(): void
    {
        $this->events += $this->checkTerminateAuction();
        $this->events += $this->changes();
        $this->events += $this->questions();
        $this->events += $this->checkQualificationResult();;
        $this->events += $this->contracts();
    }

    /**
     * @return EventEntity[]
     */
    protected function checkTerminateAuction(): array
    {
        if (!in_array($this->nPurchase->getStatus(), ['cancelled', 'unsuccessful'])) return [];
        if ($this->oPurchase->getStatus() == $this->nPurchase->getStatus()) return [];

        $biddersEmail = $this->service->getBiddersEmail();
        $requesters = $this->service->getRequesters();
        $events = [];

        if (!empty($requesters)) {
            foreach ($requesters as $requester) {
                if (!empty($biddersEmail) && in_array($requester->getEmail(), $biddersEmail)) {
                    /** @todo requester and bidder. title in email!!!! */
                    unset($biddersEmail[$requester->getEmail()]);
                }
                $events[] = new EventEntity('', $requester, [
                    'purchase' => $this->nPurchase,
                ]);
            }
        }

        if (!empty($this->service->getBidders())) {
            foreach ($this->service->getBidders() as $bidder) {
                if (!in_array($bidder->getEmail(), $biddersEmail)) continue;
                $events[] = new EventEntity('', $bidder, [
                    'purchase' => $this->nPurchase,
                ]);
            }
        }

        return $events;
    }

    /**
     * @return EventEntity[]
     */
    protected function changes(): array
    {
        $changes = $this->getAuctionChanges();
        if (empty($changes)) return [];
        $events = [];
        foreach ($this->service->getBidders() as $bidder) {
            $events[] = new EventEntity('', $bidder, [
                'purchase' => $this->nPurchase,
            ]);
        }
        return $events;
    }

    /**
     * @return array
     */
    protected function getAuctionChanges(): array
    {
        if ($this->nPurchase->getVersion() != 'PS') return [];
        if ($this->nPurchase->getStatus() != 'active.tendering') return [];
        $changes = [];

        if ($this->oPurchase->getValue()->getAmount() != $this->nPurchase->getValue()->getAmount()) {
            $changes['auction.value.amount'] = [$this->oPurchase->getValue()->getAmount(), $this->nPurchase->getValue()->getAmount()];
        }
        if ($this->oPurchase->getGuarantee()->getAmount() != $this->nPurchase->getGuarantee()->getAmount()) {
            $changes['auction.guarantee.amount'] = [$this->oPurchase->getGuarantee()->getAmount(), $this->nPurchase->getGuarantee()->getAmount()];
        }
        if ($this->oPurchase->getMinimalStep()->getAmount() != $this->nPurchase->getMinimalStep()->getAmount()) {
            $changes['auction.minimalStep.amount'] = [$this->oPurchase->getMinimalStep()->getAmount(), $this->nPurchase->getMinimalStep()->getAmount()];
        }
        return $changes;
    }

    protected function checkQualificationResult(): array
    {
        $awards = $this->getAwardsByQualificationResultEA();
        if (empty($awards)) return [];
        $events = [];
        foreach ($awards as $award) {
            switch ($award->getStatus()) {
                case '':
                    /** here is custom notification for some status */
                    break;
                default:
                    /** status doesn't exist, custom message */
            }

            /** @todo set event id */
            if ($this->service->getOwnerOfPurchase()) {
                $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                    'purchase' => $this->nPurchase,
                ]);
            }
            if ($this->service->getBidderByID($award->getBidId())) {
                $events[] = new EventEntity('', $this->service->getBidderByID($award->getBidId()), [
                    'purchase' => $this->nPurchase,
                ]);
            }
        }
        return $events;
    }

    /**
     * @return AwardEntity[]
     */
    protected function getAwardsByQualificationResultEA(): array
    {
        if (empty($this->nPurchase->getAwards())) return [];
        $newAwards = [];
        foreach ($this->nPurchase->getAwards() as $award) {
            $check = $this->getEntityInfo($this->oPurchase->getAwards(), $award->getId());
            if ($check->entity ? $check->entity->getStatus() == $award->getStatus() : !$check->new) continue;
            $newAwards[] = $award;
        }
        return $newAwards;
    }

    /**
     * @return EventEntity[]
     */
    protected function contracts(): array
    {
        $contract = $this->getActivatedContract();
        if (!$contract) return [];
        $events = [];
        /** находим победителя, а точнее bid_id, для поиска в нашей базе */
        $bidID = $this->nPurchase->getAwardById($contract->getAwardID())->getBidId();

        if ($bidID) {
            $bidder = $this->service->getBidderByID($bidID);
            if ($bidder) {
                /** @todo set event id */
                $events[] = new EventEntity('', $bidder, [
                    'purchase' => $this->nPurchase,
                ]);
                unset($bidder);
            }
        }

        if ($this->service->getOwnerOfPurchase()) {
            /** @todo set event id */
            $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
                'purchase' => $this->nPurchase,
            ]);
        }

        $bidders = $this->service->getBidders();
        if (empty($bidders)) return $events;
        foreach ($bidders as $bidder) {
            /** @todo set event id */
            $events[] = new EventEntity('', $bidder, [
                'purchase' => $this->nPurchase,
            ]);
        }
        return $events;
    }

    protected function getActivatedContract(): ?ContractEntity
    {
        if ($this->nPurchase->getStatus() != 'complete') return null;
        if ($this->nPurchase->getStatus() == $this->oPurchase->getStatus()) return null;
        if (empty($this->nPurchase->getContracts())) return null;
        foreach ($this->nPurchase->getContracts() as $contract) {
            if ($contract->getStatus() != 'active') continue;
            $check = $this->getEntityInfo($this->oPurchase->getContracts(), $contract->getId());
            if ($check->entity ? $contract->getStatus() == $check->entity->getStatus() : !$check->new) continue;
            return $contract;
        }
        return null;
    }
}