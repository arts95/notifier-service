<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender;


use app\entity\base\BaseEntity;

/**
 * Class CancellationEntity
 *
 * @package app\entity\tender
 */
class CancellationEntity extends BaseEntity
{
    protected $relatedLot;

    /**
     * @return mixed
     */
    public function getRelatedLot()
    {
        return $this->relatedLot;
    }
}