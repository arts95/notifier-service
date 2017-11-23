<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender\bid;


/**
 * Class ParameterEntity
 *
 * @package app\entity\tender\bid
 */
class ParameterEntity
{
    protected $code;
    protected $value;


    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }


    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}