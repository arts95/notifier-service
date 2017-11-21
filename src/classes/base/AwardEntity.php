<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


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

    public function __construct(array $data, ?string $key = null)
    {
        parent::__construct($data, $key);

        $this->complaintPeriod = new DateEntity($data, 'complaintPeriod');
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