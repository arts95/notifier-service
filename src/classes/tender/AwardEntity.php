<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


/**
 * Class AwardEntity
 *
 * @package app\entity\tender
 */
class AwardEntity extends \app\entity\base\AwardEntity
{
    /**
     * @return mixed
     */
    public function getLotID()
    {
        return $this->lotID;
    }
    protected $lotID;
}