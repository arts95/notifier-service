<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;


/**
 * Class UnitEntity
 *
 * @package app\entity\base\item
 */
class UnitEntity extends BaseEntity
{
    protected $code;
    protected $name;
    protected $value;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}