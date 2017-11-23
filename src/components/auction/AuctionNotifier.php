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

    protected function newQuestions()
    {
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
        if (!empty($newQuestions)) {
            /** @todo $tender, $newQuestions to $owner->email */
        }
        if (!empty($answeredQuestions)) {
            /** @todo $tender, $answeredQuestions to getEmailsQuestions() */
        }
    }

    protected function terminateAuction()
    {
        if (!in_array($this->nAuction->getStatus(), ['cancelled', 'unsuccessful'])) return;
        if ($this->oAuction->getStatus() == $this->nAuction->getStatus()) return;

        $bidderEmail = ['email1', 'email2']; /** @todo get bidders email by auction */
        $requesterEmails = ['email1', 'email3', 'email4'];/** @todo get requester emailes by auction */
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

    public function sendContractActive()
    {
        if ($this->nAuction->getStatus() != 'complete') return;
        if ($this->nAuction->getStatus() == $this->oAuction->getStatus()) return;
        if (empty($this->nAuction->getContracts())) return;
        foreach ($this->nAuction->getContracts() as $contract) {
            if ($contract->getStatus() == 'active') continue;
            $check = $this->getContractInfo($contract->getId());
            if ($check->new) {
                /** находим победителя, а точнее bid_id, для поиска в нашей базе */
                $bidID = $this->nAuction->getAwardById($contract->getAwardID())->getBidId();

                if ($bidID) {
                    /** @todo get bidder winner by id $bidder and notify */
                }

                /** @todo notify organizer! $this->owner */

                /** @todo notify other bidders from our db */
            }
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
}