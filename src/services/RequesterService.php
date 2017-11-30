<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 29.11.17
 */

namespace app\services;


use GuzzleHttp\Client;

class RequesterService
{
    private $client;
    private $type;
    private $purchaseID;

    /** @todo catch request in another way. */

    /**
     * RequesterService constructor.
     *
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        /** @todo configure from $config */
        $this->client = new Client([
            'base_uri' => 'http://notifier.dev/test/',
        ]);
        if (isset($config['type'])) {
            $this->type = $config['type'];
        } else {
            throw new \Exception('no type');
        }
        if (isset($config['purchaseID'])) {
            $this->purchaseID = $config['purchaseID'];
        } else {
            throw new \Exception('no purchaseID');
        }
    }

    public function getBidders(): array
    {
        $body = $this->client->get("{$this->type}/{$this->purchaseID}/bidders")->getBody();
        $data = json_decode($body, true);
        if ($data == null) {
            return [];
        } else {
            return $data;
        }
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
        $body = $this->client->get("{$this->type}/{$this->purchaseID}/bidders/{$bidID}")->getBody();
        $data = json_decode($body, true);
        if ($data == null) {
            return [];
        } else {
            return $data;
        }
//        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getOwnerOfPurchase(): array
    {
        $body = $this->client->get("{$this->type}/{$this->purchaseID}/owner")->getBody();
        $data = json_decode($body, true);
        if ($data == null) {
            return [];
        } else {
            return $data;
        }
//        return ['userID' => 1, 'email' => 'email@email.test', 'bid' => ['id' => 1, 'status' => 'active']];
    }

    public function getRequesters(): array
    {
        $body = $this->client->get("{$this->type}/{$this->purchaseID}/requesters")->getBody();
        $data = json_decode($body, true);
        if ($data == null) {
            return [];
        } else {
            return $data;
        }
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