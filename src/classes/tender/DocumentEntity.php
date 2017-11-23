<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender;


/**
 * Class DocumentEntity
 *
 * @package app\entity\tender
 */
class DocumentEntity extends \app\entity\base\DocumentEntity
{
    protected $confidentiality;

    /**
     * @return mixed
     */
    public function getConfidentiality()
    {
        return $this->confidentiality;
    }
}