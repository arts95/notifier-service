<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class ValueEntity
 *
 * @package app\entity\base
 */
class ValueEntity extends ValueBaseEntity
{
    protected $valueAddedTaxIncluded;

    /**
     * @return mixed
     */
    public function getValueAddedTaxIncluded(): bool
    {
        return $this->valueAddedTaxIncluded;
    }
}