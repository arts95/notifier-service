<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\base;


/**
 * Class ValueBaseEntity
 *
 * @package app\entity\base
 */
class ValueBaseEntity extends BaseEntity
{
    protected $amount;
    protected $currency;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return (float)$this->amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}