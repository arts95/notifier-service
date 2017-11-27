<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\base;

/**
 * Class Check
 *
 * @package app\components\base
 */
class Check
{
    public $entity;
    public $new;

    /**
     * Checker constructor.
     *
     * @param null|object $entity
     * @param bool $new
     */
    public function __construct(?object $entity, bool $new)
    {
        $this->entity = $entity;
        $this->new = $new;
    }

}