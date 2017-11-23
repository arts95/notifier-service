<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


/**
 * Class ContractEntity
 *
 * @package app\entity\tender
 */
class ContractEntity extends \app\entity\base\ContractEntity
{
    protected $mergedInto;

    /**
     * @return mixed
     */
    public function getMergedInto()
    {
        return $this->mergedInto;
    }

}