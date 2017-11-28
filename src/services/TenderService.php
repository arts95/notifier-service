<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 28.11.17
 */

namespace app\services;


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
}