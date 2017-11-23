<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


use app\entity\base\BaseEntity;

/**
 * Class QualificationEntity
 *
 * @package app\entity\tender
 */
class QualificationEntity extends BaseEntity
{
    public $id;
    public $title;
    public $description;
    public $qualified;
    public $eligible;
    public $status;
    public $cause;
    public $bidID;
    public $lotID;
    public $complaints;
    public $documents;
    public $date;

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
    public function getStatus()
    {
        return $this->status;
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
    public function getBidID()
    {
        return $this->bidID;
    }

    /**
     * @return mixed
     */
    public function getLotID()
    {
        return $this->lotID;
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
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $key
     * @return null|string
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'complaints' => 'app\entity\tender\ComplaintEntity',
            'documents' => 'app\entity\base\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }


}