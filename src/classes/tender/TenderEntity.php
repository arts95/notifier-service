<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */

namespace app\entity\tender;

use app\entity\base\BaseEntity;
use app\entity\base\DateEntity;
use app\entity\base\item\ItemEntity;
use app\entity\base\OrganizationEntity;
use app\entity\base\ValueBaseEntity;
use app\entity\base\ValueEntity;
use app\entity\tender\lot\LotEntity;

/**
 * Class TenderEntity
 *
 * @package app\entity\tender
 */
class TenderEntity extends BaseEntity
{
    protected $id;
    protected $title;
    protected $title_en;
    protected $titleRu;
    protected $description;
    protected $description_en;
    protected $descriptionRu;
    protected $procurementMethodRationale;
    protected $cause;
    protected $causeDescription;
    protected $procurementMethod;
    protected $procurementMethodType;
    protected $tenderID;
    protected $procuringEntity;
    protected $value;
    protected $items;
    protected $features;
    protected $documents;
    protected $questions;
    protected $complaints;
    protected $bids;
    protected $minimalStep;
    protected $awards;
    protected $contracts;
    protected $enquiryPeriod;
    protected $tenderPeriod;
    protected $auctionPeriod;
    protected $complaintPeriod;
    protected $auctionUrl;
    protected $awardPeriod;
    protected $status;
    protected $lots;
    protected $cancellations;
    protected $revisions;
    protected $qualifications;
    protected $guarantee;
    protected $qualificationPeriod;
    protected $stage2TenderID;
    protected $dateModified;
    protected $date;
    protected $NBUdiscountRate;
    protected $minimalStepPercentage;
    protected $fundingKind;
    protected $yearlyPaymentsPercentageRange;
    protected $noticePublicationDate;
    protected $minValue;

    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);
        $this->value = new ValueEntity($data, 'value');
        $this->minimalStep = new ValueEntity($data, 'minimalStep');
        $this->enquiryPeriod = new EnquiryPeriodEntity($data, 'enquiryPeriod');
        $this->complaintPeriod = new DateEntity($data, 'complaintPeriod');
        $this->tenderPeriod = new DateEntity($data, 'tenderPeriod');
        $this->awardPeriod = new DateEntity($data, 'awardPeriod');
        $this->qualificationPeriod = new DateEntity($data, 'qualificationPeriod');
        $this->procuringEntity = new OrganizationEntity($data, 'procuringEntity');
        $this->guarantee = new ValueBaseEntity($data, 'guarantee');
        $this->auctionPeriod = new AuctionPeriodEntity($data, 'auctionPeriod');
        $this->minValue = new ValueEntity($data, 'minValue');
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
    public function getTitleRu()
    {
        return $this->titleRu;
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
    public function getTenderID()
    {
        return $this->tenderID;
    }

    /**
     * @return OrganizationEntity
     */
    public function getProcuringEntity(): OrganizationEntity
    {
        return $this->procuringEntity;
    }

    /**
     * @return ValueEntity
     */
    public function getValue(): ValueEntity
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return mixed
     */
    public function getQuestions()
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
     * @return ValueEntity
     */
    public function getMinimalStep(): ValueEntity
    {
        return $this->minimalStep;
    }

    /**
     * @return mixed
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * @return EnquiryPeriodEntity
     */
    public function getEnquiryPeriod(): EnquiryPeriodEntity
    {
        return $this->enquiryPeriod;
    }

    /**
     * @return DateEntity
     */
    public function getTenderPeriod(): DateEntity
    {
        return $this->tenderPeriod;
    }

    /**
     * @return AuctionPeriodEntity
     */
    public function getAuctionPeriod(): AuctionPeriodEntity
    {
        return $this->auctionPeriod;
    }

    /**
     * @return DateEntity
     */
    public function getComplaintPeriod(): DateEntity
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
     * @return DateEntity
     */
    public function getAwardPeriod(): DateEntity
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
    public function getRevisions()
    {
        return $this->revisions;
    }

    /**
     * @return mixed
     */
    public function getQualifications()
    {
        return $this->qualifications;
    }

    /**
     * @return ValueBaseEntity
     */
    public function getGuarantee(): ValueBaseEntity
    {
        return $this->guarantee;
    }

    /**
     * @return DateEntity
     */
    public function getQualificationPeriod(): DateEntity
    {
        return $this->qualificationPeriod;
    }

    /**
     * @return mixed
     */
    public function getStage2TenderID()
    {
        return $this->stage2TenderID;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
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
    public function getNBUdiscountRate()
    {
        return $this->NBUdiscountRate;
    }

    /**
     * @return mixed
     */
    public function getMinimalStepPercentage()
    {
        return $this->minimalStepPercentage;
    }

    /**
     * @return mixed
     */
    public function getFundingKind()
    {
        return $this->fundingKind;
    }

    /**
     * @return mixed
     */
    public function getYearlyPaymentsPercentageRange()
    {
        return $this->yearlyPaymentsPercentageRange;
    }

    /**
     * @return mixed
     */
    public function getNoticePublicationDate()
    {
        return $this->noticePublicationDate;
    }

    /**
     * @return ValueEntity
     */
    public function getMinValue(): ValueEntity
    {
        return $this->minValue;
    }

    /**
     * @return mixed
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return ItemEntity[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return LotEntity[]
     */
    public function getLots(): array
    {
        return $this->lots;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'items' => 'app\entity\base\item\ItemEntity',
            'documents' => 'app\entity\tender\DocumentEntity',
            'features' => 'app\entity\tender\feature\FeatureEntity',
            'lots' => 'app\entity\tender\lot\LotEntity',
            'cancellations' => 'app\entity\tender\CancellationEntity',
            'questions' => 'app\entity\base\QuestionEntity',
            'awards' => 'app\entity\tender\AwardEntity',
            'bids' => 'app\entity\tender\bid\BidEntity',
            'complaints' => 'app\entity\tender\ComplaintEntity',
            'contracts' => 'app\entity\tender\ContractEntity',
            'qualifications' => 'app\entity\tender\QualificationEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }

}