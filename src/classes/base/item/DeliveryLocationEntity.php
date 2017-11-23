<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;

/**
 * Class DeliveryLocationEntity
 *
 * @package app\entity\base\item
 */
class DeliveryLocationEntity extends BaseEntity
{
    protected $latitude;
    protected $longitude;
    protected $elevation;

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getElevation()
    {
        return $this->elevation;
    }
}