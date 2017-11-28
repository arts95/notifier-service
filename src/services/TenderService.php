<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 28.11.17
 */

namespace app\services;


use app\entity\service\BidderEntity;
use app\entity\service\RequesterEntity;

class TenderService extends BaseService
{
    /**
     * @return RequesterEntity[]
     */
    public function getRequesters(): array
    {
        if ($this->_requesters === null) {
            /** @todo make request */
            $this->_requesters = [
                ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'pending'], ['id' => 2, 'status' => 'claim']]],
                ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'stopping'], ['id' => 2, 'status' => 'pending']]],
            ];
        }
        if (empty($this->_requesters)) return [];
        $data = [];
        foreach ($this->_requesters as $requester) {
            $data[] = new RequesterEntity($requester['userID'], $requester['email'], $requester['questions'], $requester['complaints']);
        }
        return $data;
    }

    public function getRequesterByComplaintId(string $complaintID)
    {
        /** @todo write find method !!! */
        return new RequesterEntity('userID', 'email', [], []);
    }

    /**
     * @param null|string $lotID
     * @return BidderEntity[]
     */
    public function getBidders(?string $lotID = null): array
    {
        /** @todo make request with $lotID !!! */
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
            $data[] = new BidderEntity($bidder['userID'], $bidder['email'], $bidder['bid']);
        }
        return $data;
    }

    public function getActiveBidders(?string $lotID = null): array
    {
        /** @todo write filter !!! */
        return $this->getBidders($lotID);
    }
}