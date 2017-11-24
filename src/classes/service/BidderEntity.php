<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\entity\service;


class BidderEntity extends UserEntity
{
    protected $uid;
    protected $email;
    protected $bid;

    /**
     * BidderEntity constructor.
     *
     * @param string $uid
     * @param string $email
     * @param $bid
     */
    public function __construct($uid, $email, $bid)
    {
        parent::__construct($uid, $email);
        $this->bid = new BidEntity($bid['id'] ?? null, $bid['status'] ?? null);
    }

}