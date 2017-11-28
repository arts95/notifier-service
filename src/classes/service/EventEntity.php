<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 28.11.17
 */

namespace app\entity\service;

/**
 * Class EventEntity
 *
 * @package app\entity\service
 */
class EventEntity
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var UserEntity
     */
    protected $user;
    /**
     * @var array
     */
    protected $params;

    /**
     * EventEntity constructor.
     *
     * @param string $id
     * @param UserEntity $user
     * @param array $params
     */
    public function __construct(string $id, UserEntity $user, array $params)
    {
        /** @todo check event id !!! */
        $this->id = $id;
        $this->user = $user;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}