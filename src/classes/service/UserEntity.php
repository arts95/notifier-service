<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\entity\service;

/**
 * Class UserEntity
 *
 * @package app\entity
 */
class UserEntity
{
    protected $uid;
    protected $email;

    /**
     * UserEntity constructor.
     *
     * @param $uid
     * @param $email
     */
    public function __construct(string $uid, string $email)
    {
        $this->uid = $uid;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}