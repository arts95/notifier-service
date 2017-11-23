<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender;


use app\entity\base\DateEntity;

/**
 * Class EnquiryPeriodEntity
 *
 * @package app\entity\tender
 */
class EnquiryPeriodEntity extends DateEntity
{
    protected $clarificationsUntil;

    /**
     * @return mixed
     */
    public function getClarificationsUntil()
    {
        return $this->clarificationsUntil;
    }
}