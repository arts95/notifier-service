<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\auction;


use app\entity\base\BaseEntity;
use app\entity\base\ContractEntity;
use app\entity\base\QuestionEntity;
use app\entity\tender\AwardEntity;

/**
 * Class AuctionEntity
 *
 * @package app\entity\auction
 */
class AuctionEntity extends BaseEntity
{
    protected $id;
    protected $title;
    protected $description;
    protected $procurementMethodRationale;
    protected $cause;
    protected $causeDescription;
    protected $procurementMethod;
    protected $procurementMethodType;
    protected $auctionID;
    protected $procuringEntity;
    protected $value;
    protected $items;
    protected $documents;
    protected $questions;
    protected $complaints;
    protected $bids;
    protected $minimalStep;
    /**
     * @var AwardEntity[]
     */
    protected $awards;
    protected $contracts;
    protected $enquiryPeriod;
    protected $tenderPeriod;
    protected $auctionPeriod;
    protected $complaintPeriod;
    protected $auctionUrl;
    protected $awardPeriod;
    protected $status;
    protected $cancellations;
    protected $guarantee;
    protected $qualificationPeriod;
    protected $dgfID;
    protected $eligibilityCriteria;
    protected $dgfDecisionID;
    protected $dgfDecisionDate;
    protected $tenderAttempts;
    protected $minNumberOfQualifiedBids = 2;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getProcurementMethodRationale()
    {
        return $this->procurementMethodRationale;
    }

    /**
     * @return mixed
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @return mixed
     */
    public function getCauseDescription()
    {
        return $this->causeDescription;
    }

    /**
     * @return mixed
     */
    public function getProcurementMethod()
    {
        return $this->procurementMethod;
    }

    /**
     * @return mixed
     */
    public function getProcurementMethodType()
    {
        return $this->procurementMethodType;
    }

    /**
     * @return mixed
     */
    public function getAuctionID()
    {
        return $this->auctionID;
    }

    /**
     * @return mixed
     */
    public function getProcuringEntity()
    {
        return $this->procuringEntity;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return QuestionEntity[]
     */
    public function getQuestions(): ?array
    {
        return $this->questions;
    }

    /**
     * @return mixed
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * @return mixed
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * @return mixed
     */
    public function getMinimalStep()
    {
        return $this->minimalStep;
    }

    /**
     * @return AwardEntity[]
     */
    public function getAwards(): array
    {
        return $this->awards;
    }

    /**
     * @param string $id
     * @return AwardEntity|null
     */
    public function getAwardById(string $id): ?AwardEntity
    {
        if (empty($this->awards)) return null;
        foreach ($this->awards as $award) {
            if ($award->getId() == $id) {
                return $award;
            }
        }
        return null;
    }

    /**
     * @return ContractEntity[]
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * @return mixed
     */
    public function getEnquiryPeriod()
    {
        return $this->enquiryPeriod;
    }

    /**
     * @return mixed
     */
    public function getTenderPeriod()
    {
        return $this->tenderPeriod;
    }

    /**
     * @return mixed
     */
    public function getAuctionPeriod()
    {
        return $this->auctionPeriod;
    }

    /**
     * @return mixed
     */
    public function getComplaintPeriod()
    {
        return $this->complaintPeriod;
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
    public function getAwardPeriod()
    {
        return $this->awardPeriod;
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
    public function getCancellations()
    {
        return $this->cancellations;
    }

    /**
     * @return mixed
     */
    public function getGuarantee()
    {
        return $this->guarantee;
    }

    /**
     * @return mixed
     */
    public function getQualificationPeriod()
    {
        return $this->qualificationPeriod;
    }

    /**
     * @return mixed
     */
    public function getDgfID()
    {
        return $this->dgfID;
    }

    /**
     * @return mixed
     */
    public function getEligibilityCriteria()
    {
        return $this->eligibilityCriteria;
    }

    /**
     * @return mixed
     */
    public function getDgfDecisionID()
    {
        return $this->dgfDecisionID;
    }

    /**
     * @return mixed
     */
    public function getDgfDecisionDate()
    {
        return $this->dgfDecisionDate;
    }

    /**
     * @return mixed
     */
    public function getTenderAttempts()
    {
        return $this->tenderAttempts;
    }

    /**
     * @return int
     */
    public function getMinNumberOfQualifiedBids(): int
    {
        return $this->minNumberOfQualifiedBids;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'items' => 'app\entity\base\item\ItemEntity',
            'documents' => 'app\entity\base\DocumentEntity',
            'cancellations' => 'app\entity\base\CancellationEntity',
            'questions' => 'app\entity\base\QuestionEntity',
            'awards' => 'app\entity\base\AwardEntity',
            'bids' => 'app\entity\base\BidEntity',
            'contracts' => 'app\entity\base\ContractEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}