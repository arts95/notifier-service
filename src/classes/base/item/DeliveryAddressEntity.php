<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;

/**
 * Class DeliveryAddressEntity
 *
 * @package app\entity\base\item
 */
class DeliveryAddressEntity extends BaseEntity
{
    protected $countryName;
    protected $region;
    protected $locality;
    protected $streetAddress;
    protected $postalCode;

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @return mixed
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
}