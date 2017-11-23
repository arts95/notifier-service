<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class AwardEntity
 *
 * @package app\entity\base
 */
abstract class AwardEntity extends BaseEntity
{
    protected $id;
    protected $bid_id;
    protected $title;
    protected $description;
    protected $date;
    protected $status;
    protected $value;
    protected $suppliers;
    protected $items;
    protected $documents;
    protected $complaints;
    protected $complaintPeriod;
    protected $qualified;
    protected $eligible;
    protected $cause;
    protected $subcontractingDetails;

    /**
     * AwardEntity constructor.
     *
     * @param array $data
     * @param null|string $key
     */
    public function __construct(array $data, ?string $key = null)
    {
        parent::__construct($data, $key);

        $this->complaintPeriod = new DateEntity($data, 'complaintPeriod');
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
    public function getBidId()
    {
        return $this->bid_id;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getSuppliers()
    {
        return $this->suppliers;
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
     * @return mixed
     */
    public function getComplaints()
    {
        return $this->complaints;
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
    public function getQualified()
    {
        return $this->qualified;
    }

    /**
     * @return mixed
     */
    public function getEligible()
    {
        return $this->eligible;
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
    public function getSubcontractingDetails()
    {
        return $this->subcontractingDetails;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'documents' => 'app\entity\base\DocumentEntity',
            'suppliers' => 'app\entity\base\OrganizationEntity',
            'complaints' => 'app\entity\tender\ComplaintEntity',
            'items' => 'app\entity\tender\ComplaintEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}