<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 29.11.17
 */

namespace app\entity\service;


class LotValueEntity
{
    protected $lotID;
    protected $status;

    /**
     * LotValueEntity constructor.
     *
     * @param $lotID
     * @param $status
     */
    public function __construct(?string $lotID, ?string $status)
    {
        $this->lotID = $lotID;
        $this->status = $status;
    }

    /**
     * @return null|string
     */
    public function getLotID()
    {
        return $this->lotID;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }
}