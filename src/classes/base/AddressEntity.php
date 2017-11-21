<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


class AddressEntity extends BaseEntity
{
    protected $streetAddress;
    protected $locality;
    protected $region;
    protected $postalCode;
    protected $countryName;

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