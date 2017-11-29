<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 29.11.17
 */

namespace app\services;


class RequesterService
{

    /** @todo write request */
    /**
     * RequesterService constructor.
     *
     * @param string $purchaseID
     * @param array $config
     */
    public function __construct(string $purchaseID, array $config)
    {
        /** @todo configure */
    }

    public function getBidders(): array
    {
        return [
            ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
            ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
        ];
        /**
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active', 'lotValues' => ['lotID' => '12321', 'status' => 'active']]],
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
         * ];
         */
    }

    public function getBidderByBidID(string $bidID): array
    {
        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getOwnerOfPurchase(): array
    {
        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getRequesters(): array
    {
        return [
            ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
            ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
        ];
        /**
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'pending'], ['id' => 2, 'status' => 'claim']]],
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'stopping'], ['id' => 2, 'status' => 'pending']]],
         * ];
         *
         */
    }
}