<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\entity\service;


/**
 * Class BidEntity
 *
 * @package app\entity\service
 */
class BidEntity
{
    protected $id;
    protected $status;

    /**
     * BidEntity constructor.
     *
     * @param string|null $id
     * @param string|null $status
     */
    public function __construct(?string $id, ?string $status)
    {
        $this->id = $id;
        $this->status = $status;
    }
}