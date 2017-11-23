<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\base;


/**
 * Class BidEntity
 *
 * @package app\entity\base
 */
abstract class BidEntity extends BaseEntity
{
    protected $tenderers;
    protected $date;
    protected $id;
    protected $status;
    protected $value;
    protected $documents;
    protected $participationUrl;
    protected $subcontractingDetails;

    /**
     * BidEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->value = new ValueEntity($data, 'value');
    }

    /**
     * @return mixed
     */
    public function getTenderers()
    {
        return $this->tenderers;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
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
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return mixed
     */
    public function getParticipationUrl()
    {
        return $this->participationUrl;
    }

    /**
     * @return mixed
     */
    public function getSubcontractingDetails()
    {
        return $this->subcontractingDetails;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'tenderers' => 'app\entity\base\OrganizationEntity',
            'documents' => 'app\entity\base\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}