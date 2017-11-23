<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\base;

/**
 * Class CancellationEntity
 *
 * @package app\entity\base
 */
/**
 * Class CancellationEntity
 *
 * @package app\entity\base
 */
class CancellationEntity extends BaseEntity
{
    protected $id;
    protected $reason;
    protected $status;
    protected $documents;
    protected $date;
    protected $cancellationOf;
    protected $reasonType;

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
    public function getReason()
    {
        return $this->reason;
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
     * @return mixed
     */
    public function getCancellationOf()
    {
        return $this->cancellationOf;
    }

    /**
     * @return mixed
     */
    public function getReasonType()
    {
        return $this->reasonType;
    }

    /**
     * @param string $key
     * @return null|string
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'documents' => 'app\entity\tender\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}