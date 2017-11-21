<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


use app\entity\base\BaseEntity;
use app\entity\base\OrganizationEntity;

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

    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->author = new OrganizationEntity($data, 'author');
    }


}