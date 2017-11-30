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
    public $requesterService;
    protected $_requesters = null;
    protected $_bidders = null;
    private $_bidder = null;
    private $_ownerOfPurchase = null;

    /**
     * BaseService constructor.
     *
     * @param array $requesterConfig
     */
    public function __construct(array $requesterConfig)
    {
        $this->requesterService = new RequesterService($requesterConfig);
    }

    /**
     * @return array
     */
    public function getBiddersEmail(): array
    {
        if (empty($this->getBidders())) return [];
        $emails = [];
        foreach ($this->getBidders() as $bidder) {
            $emails[] = $bidder->getEmail();
        }
        return $emails;
    }

    /**
     * @return BidderEntity[]
     */
    public function getBidders(): array
    {
        if ($this->_bidders === null) {
            $this->_bidders = $this->requesterService->getBidders();
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
        /** @todo rewrite this */
        if ($this->_bidder == null) {
            $this->_bidder = $this->requesterService->getBidderByBidID($bidID);
        }
        return new BidderEntity($this->_bidder['userID'], $this->_bidder['email'], $this->_bidder['bid']);
    }

    public function getOwnerOfPurchase(): UserEntity
    {
        if ($this->_ownerOfPurchase == null) {
            $this->_ownerOfPurchase = $this->requesterService->getOwnerOfPurchase();
        }
        return new UserEntity($this->_ownerOfPurchase['id'], $this->_ownerOfPurchase['email']);
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
            $this->_requesters = $this->requesterService->getRequesters();
        }
        if (empty($this->_requesters)) return [];
        $data = [];
        foreach ($this->_requesters as $requester) {
            $data[] = new RequesterEntity($requester['id'], $requester['email'], $requester['questions'], []);
        }
        return $data;
    }
}