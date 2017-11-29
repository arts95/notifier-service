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
        $this->service = new AuctionService($this->nPurchase->getId(), []);
    }

    public static function getNotifier(AuctionEntity $oAuction, AuctionEntity $nAuction): AuctionNotifier
    {
        return new AuctionNotifier($oAuction, $nAuction);
    }

    public function analyze(): void
    {
        $this->tender();
        $this->questions();
        $this->awards();
        $this->contracts();
    }

    protected function tender(): void
    {
        $this->terminateAuction();
        $this->changes();
    }

    /**
     * @return bool
     */
    protected function terminateAuction(): bool
    {
        if (!in_array($this->nPurchase->getStatus(), ['cancelled', 'unsuccessful'])) return false;
        if ($this->oPurchase->getStatus() == $this->nPurchase->getStatus()) return false;

        $bidderEmail = $this->service->getBiddersEmail();
        $requesterEmails = $this->service->getRequestersEmail();

        if (!empty($requesterEmails)) {
            foreach ($requesterEmails as $email) {
                if (!empty($bidderEmail) && in_array($email, $bidderEmail)) {
                    /** @todo requester and bidder. title in email!!!! */
                    unset($bidderEmail[$email]);
                }

                /** @todo notify */
            }
        }

        if (!empty($bidderEmail)) {
            foreach ($bidderEmail as $email) {
                /** @todo notify */
            }
        }

        return true;
    }

    protected function changes(): void
    {
        $changes = $this->getAuctionChanges();
        if (empty($changes)) return;
        foreach ($this->service->getBidders() as $bidder) {
            /** @todo notify $bidder */
        }
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

    protected function awards(): void
    {
        $this->qualificationResult();
    }

    protected function qualificationResult(): void
    {
        if ($this->nPurchase->getVersion() == 'PS') {
            $this->qualificationResultPS();
        } else {
            $awards = $this->getAwardsByQualificationResultEA();
            if (empty($awards)) return;
            foreach ($awards as $award) {
                switch ($award->getStatus()) {
                    case '':
                        /** here is custom notification for some status */
                        break;
                    default:
                        /** status doesn't exist, custom message */
                }

                /** @todo notify bidder and organizer */
                $this->service->getOwnerOfPurchase();
                $this->service->getBidderByID($award->getBidId());
            }
        }
    }

    /**
     * Сообщение о результатах квалификации
     * Версия 2.3
     *
     * Отсілаем письмо, если статусі квалификации поменялись.
     * Отсілаем письмо вторім-третим-десятім участникам о возможности победить
     *
     */
    protected function qualificationResultPS()
    {
        if (empty($this->nPurchase->getAwards())) return;
        $bidIdInAward = [];
        foreach ($this->nPurchase->getAwards() as $award) {
            $check = $this->getEntityInfo($this->oPurchase->getAwards(), $award->getId());

            if (in_array($award->getStatus(), ['pending', 'unsuccessful', 'cancelled'])) {
                /** статусі, когда другие участники еще могут победить */
                $bidIdInAward[] = $award['bid_id'];
            } elseif ($award->getStatus() == 'cancelled') {
                /** @todo notify organizer */
                $this->service->getOwnerOfPurchase();
            }

            /** письмо про то статус квалификации участника перешел в указазаніе статусі */
            if ($check->new && ($check->entity ? $check->entity->getStatus() != $award->getStatus() : true)) {
                /** @todo and notify */
                $bidder = $this->service->getBidderByID($award->getBidId());
            }

        }
        /** отправляем письмо только один раз, сразу после того, как закончился аукцион */
        if ($this->nPurchase->getStatus() != 'active.qualification') return;
        if ($this->nPurchase->getStatus() == $this->oPurchase->getStatus()) return;
        if (empty($this->nPurchase->getBids())) return;
        if (empty($bidIdInAward)) return;

        /** теперь вібираем участников которіе не первіе в очереди */
        foreach ($this->nPurchase->getBids() as $bid) {
            /** отсеиваем тех, которіе первіе по счету и им уже отправили письмо о активной квалификации*/
            if ($bid->getStatus() != 'active') continue;
            /** @todo notify */
            $bidder = $this->service->getBidderByID($bid->getId());
        }
    }

    /**
     * Сообщение о результатах квалификации первому и второму участнику
     * Версия 2.4
     *
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

    protected function contracts(): void
    {
        $contract = $this->getActivatedContract();
        if (!$contract) return;
        /** находим победителя, а точнее bid_id, для поиска в нашей базе */
        $bidID = $this->nPurchase->getAwardById($contract->getAwardID())->getBidId();

        if ($bidID) {
            /** @todo notify */
            $bidder = $this->service->getBidderByID($bidID);
        }

        /** @todo notify organizer! */
        $this->service->getOwnerOfPurchase();

        /** @todo notify other bidders from our db */
        $bidders = $this->service->getBidders();
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