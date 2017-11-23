<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender;


use app\entity\base\DateEntity;

/**
 * Class AuctionPeriodEntity
 *
 * @package app\entity\tender
 */
class AuctionPeriodEntity extends DateEntity
{
    protected $shouldStartAfter;

    /**
     * @return string
     */
    public function getShouldStartAfter()
    {
        return $this->shouldStartAfter;
    }

}