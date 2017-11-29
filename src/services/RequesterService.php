<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 29.11.17
 */

namespace app\services;


use GuzzleHttp\Client;

class RequesterService
{
    private const _TYPE_AUCTION = 'auction';
    private const _TYPE_TENDER = 'tender';
    private $client;
    private $type;
    private $purchaseID;

    /** @todo write request */

    /**
     * RequesterService constructor.
     *
     * @param string $purchaseID
     * @param array $config
     */
    public function __construct(string $purchaseID, array $config)
    {
        /** @todo configure from $config */
        $this->client = new Client([
            'base_uri' => 'http://notifier.dev/test/',
        ]);
    }

    public function getBidders(): array
    {
        $body = $this->client->get('bidders', [
            'type' => $this->type,
            'purchaseID' => $this->purchaseID,
        ])->getBody();
        return $data = json_decode($body, true);
        /**
         * auction
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
         * ];
         * tender
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active', 'lotValues' => ['lotID' => '12321', 'status' => 'active']]],
         * ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']],
         * ];
         */
    }

    public function getBidderByBidID(string $bidID): array
    {
        $body = $this->client->get('bidders', [
            'type' => $this->type,
            'purchaseID' => $this->purchaseID,
            'bidID' => $bidID,
        ])->getBody();
        return $data = json_decode($body, true);
//        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getOwnerOfPurchase(): array
    {
        $body = $this->client->get('owner', [
            'type' => $this->type,
            'purchaseID' => $this->purchaseID,
        ])->getBody();
        return $data = json_decode($body, true);
//        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getRequesters(): array
    {
        $body = $this->client->get('requesters', [
            'type' => $this->type,
            'purchaseID' => $this->purchaseID,
        ])->getBody();
        return $data = json_decode($body, true);
        /**
         * auction
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]]],
         * ];
         *
         * tender
         * return [
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'pending'], ['id' => 2, 'status' => 'claim']]],
         * ['userID' => 1, 'email' => 'email@email.test', 'questions' => [['id' => 1], ['id' => 2]], 'complaints' => [['id' => 1, 'status' => 'stopping'], ['id' => 2, 'status' => 'pending']]],
         * ];
         *
         */
    }
}