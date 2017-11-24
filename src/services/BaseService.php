<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\services;


use app\entity\service\BidderEntity;
use app\entity\service\RequesterEntity;
use app\entity\service\UserEntity;

/**
 * Class BaseService
 *
 * @package app\services
 */
class BaseService
{
    protected $purchaseID;
    private $_requesters = null;
    private $_bidders = null;
    private $_bidder = null;
    private $_ownerOfPurchase = null;
    /** @todo make variables for multiply call functions */
    /**
     * BaseService constructor.
     *
     * @param $purchaseID
     */
    public function __construct($purchaseID)
    {
        $this->purchaseID = $purchaseID;
    }

    public function getBiddersEmail()
    {
        $this->getBidders();
        /** @todo get emails */
        return [
            ['email' => 'email@email.test'],
            ['email' => 'email@email.test'],
        ];
    }

    public function getBidders(): array
    {
        if ($this->_bidders === null) {
            /** @todo make request. */
            $this->_bidders = [
                ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
                ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
            ];
        }
        if (empty($this->_bidders)) return [];
        $data = [];
        foreach ($this->_bidders as $bidder) {
            $data[] = new BidderEntity($bidder['id'], $bidder['email'], $bidder['bid']);
        }
        return $data;
    }

    public function getBidderByID($bidID): BidderEntity
    {
        if ($this->_bidder == null) {
            /** @todo make request. */
            $this->_bidder = ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
        }
        return new BidderEntity($this->_bidder['userID'], $this->_bidder['email'], $this->_bidder['bid']);
    }

    public function getOwnerOfPurchase(): UserEntity
    {
        if ($this->_ownerOfPurchase == null) {
            /** @todo make request. */
            $this->_ownerOfPurchase = ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
        }
        return new UserEntity($this->_ownerOfPurchase['userID'], $this->_ownerOfPurchase['email']);
    }

    public function getRequestersEmail(): array
    {
        if (empty($this->getRequesters())) return [];
        $emails = [];
        foreach ($this->getRequesters() as $requester) {
            $emails[] = $requester->getEmail();
        }
        return $emails;
    }

    /**
     * @return RequesterEntity[]
     */
    public function getRequesters(): array
    {
        if ($this->_requesters === null) {
            /** @todo make request */
            $this->_requesters = [
                ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
                ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
            ];
        }
        if (empty($this->_requesters)) return [];
        $data = [];
        foreach ($this->_requesters as $requester) {
            $data[] = new RequesterEntity($requester['userID'], $requester['email'], $requester['questions']);
        }
        return $data;
    }
}