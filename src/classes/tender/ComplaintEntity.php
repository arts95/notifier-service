<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


use app\entity\base\BaseEntity;
use app\entity\base\OrganizationEntity;

/**
 * Class ComplaintEntity
 *
 * @package app\entity\tender
 */
class ComplaintEntity extends BaseEntity
{
    protected $id;
    protected $author;
    protected $title;
    protected $description;
    protected $date;
    protected $status;
    protected $type;
    protected $resolution;
    protected $resolutionType;
    protected $relatedLot;
    protected $documents;
    protected $tendererAction;
    protected $cancellationReason;
    protected $dateCanceled;
    protected $dateAnswered;
    protected $dateSubmitted;
    protected $satisfied;
    protected $complaintID;

    /**
     * ComplaintEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->author = new OrganizationEntity($data, 'author');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return OrganizationEntity
     */
    public function getAuthor(): OrganizationEntity
    {
        return $this->author;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @return mixed
     */
    public function getResolutionType()
    {
        return $this->resolutionType;
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
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return mixed
     */
    public function getTendererAction()
    {
        return $this->tendererAction;
    }

    /**
     * @return mixed
     */
    public function getCancellationReason()
    {
        return $this->cancellationReason;
    }

    /**
     * @return mixed
     */
    public function getDateCanceled()
    {
        return $this->dateCanceled;
    }

    /**
     * @return mixed
     */
    public function getDateAnswered()
    {
        return $this->dateAnswered;
    }

    /**
     * @return mixed
     */
    public function getDateSubmitted()
    {
        return $this->dateSubmitted;
    }

    /**
     * @return mixed
     */
    public function getSatisfied()
    {
        return $this->satisfied;
    }

    /**
     * @return mixed
     */
    public function getComplaintID()
    {
        return $this->complaintID;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'documents' => 'app\entity\base\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}