<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\tender\lot;


use app\entity\base as base;

/**
 * Class LotEntity
 *
 * @package app\entity\tender\lot
 */
class LotEntity extends base\BaseEntity
{
    protected $id;
    protected $title;
    protected $title_en;
    protected $description;
    protected $description_en;
    protected $value;
    protected $minimalStep;
    protected $auctionPeriod;
    protected $auctionUrl;
    protected $status;
    protected $guarantee;

    /**
     * LotEntity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->value = new base\ValueEntity($data, 'value');
        $this->minimalStep = new base\ValueEntity($data, 'minimalStep');
        $this->auctionPeriod = new base\DateEntity($data, 'auctionPeriod');
        $this->guarantee = new base\ValueEntity($data, 'guarantee');
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getTitleEn()
    {
        return $this->title_en;
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
     * @return base\ValueEntity
     */
    public function getValue(): base\ValueEntity
    {
        return $this->value;
    }

    /**
     * @return base\ValueEntity
     */
    public function getMinimalStep(): base\ValueEntity
    {
        return $this->minimalStep;
    }

    /**
     * @return base\DateEntity
     */
    public function getAuctionPeriod(): base\DateEntity
    {
        return $this->auctionPeriod;
    }

    /**
     * @return mixed
     */
    public function getAuctionUrl()
    {
        return $this->auctionUrl;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return base\ValueEntity
     */
    public function getGuarantee(): base\ValueEntity
    {
        return $this->guarantee;
    }
}