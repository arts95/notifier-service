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
     * @param string $complaintID
     * @return RequesterEntity|null
     */
    public function getRequesterByComplaintId(string $complaintID): ?RequesterEntity
    {
        if (empty($this->getRequesters())) return null;
        foreach ($this->getRequesters() as $requester) {
            if (empty($requester->getComplaintsId())) continue;
            if (in_array($complaintID, $requester->getComplaintsId())) {
                return $requester;
            }
        }
        return null;
    }

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

    /**
     * @param null|string $lotID
     * @return array
     */
    public function getActiveBidders(?string $lotID = null): array
    {
        if (empty($this->getBidders($lotID))) return [];
        $bidders = [];
        foreach ($this->getBidders($lotID) as $bidder) {
            if ($bidder->getBid()->getStatus() !== 'active') continue;
            $bidders[] = $bidder;
        }
        return $bidders;
    }

    /**
     * @param null|string $lotID
     * @return BidderEntity[]
     */
    public function getBidders(?string $lotID = null): array
    {
        if ($this->_bidders === null) {
            /** @todo make request. */
            $this->_bidders = [
                ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active', 'lotValues' => ['lotID' => '12321', 'status' => 'active']]],
                ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
            ];
        }
        if (empty($this->_bidders)) return [];
        $data = [];
        foreach ($this->_bidders as $bidder) {
            if ($lotID !== null) {
                $bidder = new BidderEntity($bidder['userID'], $bidder['email'], $bidder['bid']);
                if (in_array($lotID, $bidder->getBid()->getLotValues())) {
                    $data[] = $bidder;
                }
                unset($bidder);
            } else {
                $data[] = new BidderEntity($bidder['userID'], $bidder['email'], $bidder['bid']);
            }
        }
        return $data;
    }
}