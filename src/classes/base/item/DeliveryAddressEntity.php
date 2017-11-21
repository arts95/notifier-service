<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */
namespace app\entity\base\item;

use app\entity\base\BaseEntity;

class DeliveryAddressEntity extends BaseEntity
{
    protected $countryName;
    protected $region;
    protected $locality;
    protected $streetAddress;
    protected $postalCode;
}