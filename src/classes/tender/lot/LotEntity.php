<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\tender\lot;


use app\entity\base as base;

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

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->value = new base\ValueEntity($data, 'value');
        $this->minimalStep = new base\ValueEntity($data, 'minimalStep');
        $this->auctionPeriod = new base\DateEntity($data, 'auctionPeriod');
        $this->guarantee = new base\ValueEntity($data, 'guarantee');
    }
}