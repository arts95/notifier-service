<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base as base;

class ItemEntity extends base\BaseEntity
{
    protected $id;
    protected $description;
    protected $description_en;
    protected $descriptionRu;
    protected $classification;
    protected $additionalClassifications;
    protected $unit;
    protected $quantity;
    protected $deliveryDate;
    protected $deliveryAddress;
    protected $deliveryLocation;
    protected $relatedLot;


    public function __construct($data)
    {
        parent::__construct($data);

        $this->unit = new UnitEntity($data, 'unit');
        $this->deliveryDate = new base\DateEntity($data, 'deliveryDate');
        $this->deliveryAddress = new DeliveryAddressEntity($data, 'deliveryAddress');
        $this->deliveryLocation = new DeliveryLocationEntity($data, 'deliveryLocation');
        $this->classification = new ClassificationEntity($data, 'classification');
    }
}