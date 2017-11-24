<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\services;


class BaseService
{
    protected $purchaseID;
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

    public function getBidders()
    {

        /** @todo make request. */
        return [
            ['bidID' => 1, 'userID' => 1, 'email' => 'email@email.test'],
            ['bidID' => 2, 'userID' => 1, 'email' => 'email@email.test'],
        ];
    }

    public function getBidderByID($bidID)
    {
        /** @todo make request. */
        /** @todo write entity */
        return ['bidID' => 1, 'userID' => 1, 'email' => 'email@email.test'];
    }

    public function getOwnerOfPurchase()
    {
        /** @todo make request and get owner of purchase. */
        return ['userID' => 2, 'email' => 'email@email.test'];
    }

    public function getRequestersEmail()
    {
        $this->getRequesters();
        /** @todo get emails */
        return [
            ['email' => 'email1@email.test'],
            ['email' => 'email2@email.test'],
        ];
    }

    public function getRequesters()
    {
        /** @todo make request and get requesters (analog of questions) */
        return [
            ['questionID' => 1, 'userID' => 1, 'email' => 'email@email.test'],
            ['questionID' => 2, 'userID' => 1, 'email' => 'email@email.test'],
        ];
    }
}