<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\entity\tender\bid;


use app\entity\base\ValueEntity;

/**
 * Class BidValueEntity
 *
 * @package app\entity\tender\bid
 */
class BidValueEntity extends ValueEntity
{
    protected $annualCostsReduction;
    protected $yearlyPaymentsPercentage;
    protected $amountPerformance;
    protected $contractDuration;

    /**
     * BidValueEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);
        $this->contractDuration = new ContractDurationEntity($data, 'contractDuration');
    }


    /**
     * @return mixed
     */
    public function getAnnualCostsReduction()
    {
        return $this->annualCostsReduction;
    }

    /**
     * @return mixed
     */
    public function getYearlyPaymentsPercentage()
    {
        return $this->yearlyPaymentsPercentage;
    }

    /**
     * @return mixed
     */
    public function getAmountPerformance()
    {
        return $this->amountPerformance;
    }

    /**
     * @return mixed
     */
    public function getContractDuration()
    {
        return $this->contractDuration;
    }
}