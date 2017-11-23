<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\entity\tender\bid;


use app\entity\base\BaseEntity;

/**
 * Class LotValueEntity
 *
 * @package app\entity\tender\bid
 */
class LotValueEntity extends BaseEntity
{
    protected $value;
    protected $relatedLot;
    protected $date;
    protected $status;
    protected $participationUrl;

    /**
     * LotValueEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);
        $data = $this->getDataByKey($data, $key);
        $this->value = new BidValueEntity($data, 'value');
    }

    /**
     * @return BidValueEntity
     */
    public function getValue(): BidValueEntity
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getRelatedLot()
    {
        return $this->relatedLot;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getParticipationUrl()
    {
        return $this->participationUrl;
    }
}