<?php

namespace app\entity\base;
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

/**
 * Class DateEntity
 *
 * @package app\entity\base
 */
class DateEntity extends BaseEntity
{
    protected $startDate;
    protected $endDate;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

}