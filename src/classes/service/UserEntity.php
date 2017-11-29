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
    protected $id;
    protected $email;

    /**
     * UserEntity constructor.
     *
     * @param $id
     * @param $email
     */
    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}