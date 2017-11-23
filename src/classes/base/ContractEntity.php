<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\base;


/**
 * Class ContractEntity
 *
 * @package app\entity\base
 */
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

    /**
     * ContractEntity constructor.
     *
     * @param array $data
     * @param null|string $key
     */
    public function __construct(array $data, ?string $key = null)
    {
        parent::__construct($data, $key);

        $this->period = new DateEntity($data, 'period');
        $this->value = new ValueEntity($data, 'value');
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
    public function getAwardID()
    {
        return $this->awardID;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return DateEntity
     */
    public function getPeriod(): DateEntity
    {
        return $this->period;
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
    public function getDateSigned()
    {
        return $this->dateSigned;
    }

    /**
     * @return mixed
     */
    public function getContractNumber()
    {
        return $this->contractNumber;
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
    public function getAdditionalAwardIDs()
    {
        return $this->additionalAwardIDs;
    }

    /**
     * @return mixed
     */
    public function getContractID()
    {
        return $this->contractID;
    }

    /**
     * @return mixed
     */
    public function getSuppliers()
    {
        return $this->suppliers;
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
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}