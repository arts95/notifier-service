<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\entity;

/**
 * Class UserEntity
 *
 * @package app\entity
 */
class UserEntity
{
    protected $uid;
    protected $email;
    protected $questionsID;

    /**
     * UserEntity constructor.
     *
     * @param $uid
     * @param $email
     * @param $questionsID
     */
    public function __construct($uid, $email, $questionsID = null)
    {
        $this->uid = $uid;
        $this->email = $email;
        $this->questionsID = $questionsID;
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

    /**
     * @return array|null
     */
    public function getQuestionsID(): ?array
    {
        return $this->questionsID;
    }

    /**
     * @param null $questionsID
     */
    public function setQuestionsID($questionsID)
    {
        $this->questionsID = $questionsID;
    }
}