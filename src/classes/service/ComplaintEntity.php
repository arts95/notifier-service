<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 28.11.17
 */

namespace app\entity\service;

/**
 * Class ComplaintEntity
 *
 * @package app\entity\service
 */
class ComplaintEntity
{
    protected $id;
    protected $status;

    /**
     * QuestionEntity constructor.
     *
     * @param string|null $id
     * @param string|null $status
     */
    public function __construct(?string $id, ?string $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }
}