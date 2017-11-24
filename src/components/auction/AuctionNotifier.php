<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\auction;

use app\components\base\Check;
use app\components\base\Notifier;
use app\entity\auction\AuctionEntity;
use app\entity\UserEntity;
use app\services\AuctionService;

/**
 * Class AuctionNotifier
 *
 * @package app\components\auction
 */
class AuctionNotifier extends Notifier
{
    private $oAuction;
    private $nAuction;
    private $owner;
    private $service;

    /**
     * AuctionNotifier constructor.
     *
     * @param AuctionEntity $oAuction
     * @param AuctionEntity $nAuction
     * @param UserEntity $owner
     */
    public function __construct(AuctionEntity $oAuction, AuctionEntity $nAuction, UserEntity $owner)
    {
        $this->oAuction = $oAuction;
        $this->nAuction = $nAuction;
        $this->owner = $owner;
        $this->service = new AuctionService();
    }

    public static function getNotifier(AuctionEntity $oAuction, AuctionEntity $nAuction, UserEntity $owner): AuctionNotifier
    {
        return new AuctionNotifier($oAuction, $nAuction, $owner);
    }

    protected function contractActivated()
    {
        if ($this->nAuction->getStatus() != 'complete') return;
        if ($this->nAuction->getStatus() == $this->oAuction->getStatus()) return;
        if (empty($this->nAuction->getContracts())) return;
        foreach ($this->nAuction->getContracts() as $contract) {
            if ($contract->getStatus() != 'active') continue;
            $check = $this->getContractInfo($contract->getId());
            if ($contract->getStatus() == $check->entity->getStatus()) continue;
            if (!$check->new) continue;

            /** находим победителя, а точнее bid_id, для поиска в нашей базе */
            $bidID = $this->nAuction->getAwardById($contract->getAwardID())->getBidId();

            if ($bidID) {
                /** @todo get bidder winner by id $bidder and notify */
            }

            /** @todo notify organizer! $this->owner */

            /** @todo notify other bidders from our db */
        }
    }

    /**
     * @param string $id
     * @return Check
     */
    protected function getContractInfo(string $id): Check
    {
        if (empty($this->oAuction->getContracts())) return new Check(null, true);
        foreach ($this->oAuction->getContracts() as $contract) {
            if ($contract->getId() == $id) {
                return new Check($contract, false);
            }
        }
        return new Check(null, true);
    }

    protected function qualificationResult()
    {
        if ($this->nAuction->getVersion() == 'PS') {
            /** @todo normal check */
            $this->qualificationResultPS();
        } else {
            $this->qualificationResultEA();
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
        if (empty($this->nAuction->getAwards())) return;
        $bidIdInAward = [];
        foreach ($this->nAuction->getAwards() as $award) {
            $check = $this->getAwardInfo($award->getId());

            if (in_array($award->getStatus(), ['pending', 'unsuccessful', 'cancelled'])) {
                /** статусі, когда другие участники еще могут победить */
                $bidIdInAward[] = $award['bid_id'];
            } elseif ($award->getStatus() == 'cancelled') {
                /** @todo notify organizer */
            }

            /** письмо про то статус квалификации участника перешел в указазаніе статусі */
            if ($check->new && ($check->entity ? $check->entity->getStatus() != $award->getStatus() : true)) {
                /** @todo get bidder and notify */
            }

        }
        /** отправляем письмо только один раз, сразу после того, как закончился аукцион */
        if ($this->nAuction->getStatus() != 'active.qualification') return;
        if ($this->nAuction->getStatus() == $this->oAuction->getStatus()) return;
        if (empty($this->nAuction->getBids())) return;
        if (empty($bidIdInAward)) return;

        /** теперь вібираем участников которіе не первіе в очереди */
        foreach ($this->nAuction->getBids() as $bid) {
            /** отсеиваем тех, которіе первіе по счету и им уже отправили письмо о активной квалификации*/
            if ($bid->getStatus() != 'active') continue;
            /** @todo get bidder and notify him */
        }
    }

    /**
     * Проверяет изменился ли статус аварда, если $type = check. Если $type = status, возвращает его статус
     *
     * @param string $id
     * @return Check
     */
    protected function getAwardInfo(string $id): Check
    {
        if (empty($this->oAuction->getAwards())) return new Check(null, true);
        foreach ($this->oAuction->getAwards() as $award) {
            if ($award->getId() == $id) {
                return new Check($award, false);
            }
        }
        return new Check(null, true);
    }

    /**
     * Сообщение о результатах квалификации первому и второму участнику
     * Версия 2.4
     *
     */
    protected function qualificationResultEA()
    {
        if (empty($this->nAuction->getAwards())) return;
        foreach ($this->nAuction->getAwards() as $award) {
            $check = $this->getAwardInfo($award->getId());
            if ($check->new && ($check->entity ? $check->entity->getStatus() != $award->getStatus() : true)) {
                switch ($award->getStatus()) {
                    /**
                     * Очікується завантаження та підтвердження протоколу ліквідатором.
                     */
                    case 'pending.verification':
                        /** here is custom notification */
                        break;
                    /**
                     * Учасник з другою найбільшою валідною ставкою чекає поки завершиться процес кваліфікації
                     * учасника з найвищою валідною ставкою. Він може прийняти рішення не чекати, та забрати
                     * свій гарантійний внесок, автоматично дискваліфікувавшись.
                     */
                    case 'pending.waiting':
                        /** here is custom notification */
                        break;
                    /**
                     * Очікується оплата. Організатор (ліквідатор) може перевести в статус active шляхом
                     * підтвердження оплати.
                     */
                    case 'pending.payment':
                        /** here is custom notification */
                        break;
                    /**
                     * Очікується підписання/активація контракту (завантажується та активується в системі
                     * організатором). Після закінчення періоду підписання (“signingPeriod”), статус “active” стає
                     * термінальним.
                     */
                    case 'active':
                        /** here is custom notification */
                        break;
                    /**
                     * Термінальний статус. Учасник з другою найвищою валідною ставкою вирішив забрати свій
                     * гарантійний внесок та не чекати на дискваліфікацію учасника з найвищою ставкою.
                     */
                    case 'cancelled':
                        /** here is custom notification */
                        break;
                    default:
                        /** Если указаного статуса в списке нет, то будет отправляться стандартное письмо */
                }

                /** @todo notify bidder */

            }
        }
    }

    protected function questions()
    {
        /** this function shoul prepare data */
        if (empty($this->nAuction->getQuestions())) return;
        $newQuestions = $answeredQuestions = [];

        foreach ($this->nAuction->getQuestions() as $question) {
            $info = $this->getQuestionInfo($question->getId());
            if ($info->new) {
                $newQuestions[$question->getId()] = $question;
            } else {
                if (empty($info->entity->getAnswer()) && !empty($question->getAnswer())) {
                    $answeredQuestions[$question->getId()] = $question;
                }
            }
        }
        $this->newQuestions($newQuestions);
        $this->newAnswerOnQuestions($answeredQuestions);
    }

    protected function newQuestions($questions)
    {
        if (empty($questions)) return false;
        /** @todo $tender, $newQuestions to $owner->email */
    }

    protected function newAnswerOnQuestions($questions)
    {
        if (empty($questions)) return false;
        /** @todo $tender, $answeredQuestions to getEmailsQuestions() */
    }

    /**
     * @param string $id
     * @return Check
     */
    protected function getQuestionInfo(string $id): Check
    {
        if (empty($this->oAuction->getQuestions())) return new Check(null, true);
        foreach ($this->oAuction->getQuestions() as $question) {
            if ($question->getId() == $id) {
                return new Check($question, true);
            }
        }
        return new Check(null, false);
    }

    protected function terminateAuction()
    {
        if (!in_array($this->nAuction->getStatus(), ['cancelled', 'unsuccessful'])) return;
        if ($this->oAuction->getStatus() == $this->nAuction->getStatus()) return;

        $bidderEmail = ['email1', 'email2'];
        /** @todo get bidders email by auction */
        $requesterEmails = ['email1', 'email3', 'email4'];
        /** @todo get requester emails by auction */
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
    }

    protected function auctionChanges()
    {
        if ($this->nAuction->getVersion() != 'PS') return;
        if ($this->nAuction->getStatus() != 'active.tendering') return;
        $changes = [];


        if ($this->oAuction->getValue()->getAmount() != $this->nAuction->getValue()->getAmount()) {
            $changes['auction.value.amount'] = [$this->oAuction->getValue()->getAmount(), $this->nAuction->getValue()->getAmount()];
        }
        if ($this->oAuction->getGuarantee()->getAmount() != $this->nAuction->getGuarantee()->getAmount()) {
            $changes['auction.guarantee.amount'] = [$this->oAuction->getGuarantee()->getAmount(), $this->nAuction->getGuarantee()->getAmount()];
        }
        if ($this->oAuction->getMinimalStep()->getAmount() != $this->nAuction->getMinimalStep()->getAmount()) {
            $changes['auction.minimalStep.amount'] = [$this->oAuction->getMinimalStep()->getAmount(), $this->nAuction->getMinimalStep()->getAmount()];
        }

        /** @todo get bidders and notify */
    }
}