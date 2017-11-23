<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\entity\tender\bid;


use app\entity\base\BaseEntity;

/**
 * Class ContractDurationEntity
 *
 * @package app\entity\tender\bid
 */
class ContractDurationEntity extends BaseEntity
{
    protected $years;
    protected $days;

    /**
     * @return mixed
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

}