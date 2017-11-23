<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base as base;

/**
 * Class ItemEntity
 *
 * @package app\entity\base\item
 */
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

    /**
     * ItemEntity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->unit = new UnitEntity($data, 'unit');
        $this->deliveryDate = new base\DateEntity($data, 'deliveryDate');
        $this->deliveryAddress = new DeliveryAddressEntity($data, 'deliveryAddress');
        $this->deliveryLocation = new DeliveryLocationEntity($data, 'deliveryLocation');
        $this->classification = new ClassificationEntity($data, 'classification');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * @return mixed
     */
    public function getDescriptionRu()
    {
        return $this->descriptionRu;
    }

    /**
     * @return ClassificationEntity
     */
    public function getClassification(): ClassificationEntity
    {
        return $this->classification;
    }

    /**
     * @return mixed
     */
    public function getAdditionalClassifications()
    {
        return $this->additionalClassifications;
    }

    /**
     * @return UnitEntity
     */
    public function getUnit(): UnitEntity
    {
        return $this->unit;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return base\DateEntity
     */
    public function getDeliveryDate(): base\DateEntity
    {
        return $this->deliveryDate;
    }

    /**
     * @return DeliveryAddressEntity
     */
    public function getDeliveryAddress(): DeliveryAddressEntity
    {
        return $this->deliveryAddress;
    }

    /**
     * @return DeliveryLocationEntity
     */
    public function getDeliveryLocation(): DeliveryLocationEntity
    {
        return $this->deliveryLocation;
    }

    /**
     * @return mixed
     */
    public function getRelatedLot()
    {
        return $this->relatedLot;
    }
}