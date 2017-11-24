<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\entity\service;


class QuestionEntity
{
    protected $id;

    /**
     * QuestionEntity constructor.
     *
     * @param string|null $id
     */
    public function __construct(?string $id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

}