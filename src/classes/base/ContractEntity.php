<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\base;


abstract class ContractEntity extends BaseEntity
{
    protected $id;
    protected $awardID;
    protected $title;
    protected $description;
    protected $status;
    protected $period;
    protected $value;
    protected $dateSigned;
    protected $contractNumber;
    protected $documents;
    protected $additionalAwardIDs;
    protected $contractID;
    protected $suppliers;

    public function __construct(array $data, ?string $key = null)
    {
        parent::__construct($data, $key);

        $this->period = new DateEntity($data, 'period');
        $this->value = new ValueEntity($data, 'value');
    }


    /**
     * @param $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key)
    {
        $mapper = [
            'documents' => 'app\entity\base\DocumentEntity',
            'suppliers' => 'app\entity\base\OrganizationEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}