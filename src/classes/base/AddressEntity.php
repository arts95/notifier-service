<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class AddressEntity
 *
 * @package app\entity\base
 */
class AddressEntity extends BaseEntity
{
    protected $streetAddress;
    protected $locality;
    protected $region;
    protected $postalCode;
    protected $countryName;

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
    public function getLocality()
    {
        return $this->locality;
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
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getFullAddressForView(): string
    {
        return "{$this->postalCode}, 
                 {$this->countryName}, 
                 {$this->streetAddress}, 
                 {$this->region}, 
                 {$this->locality}";
    }
}