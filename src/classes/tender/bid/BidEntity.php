<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender\bid;


use app\entity\base\BaseEntity;

/**
 * Class BidEntity
 *
 * @package app\entity\tender\bid
 */
class BidEntity extends BaseEntity
{
    protected $lotValues;
    protected $eligibilityDocuments;
    protected $financialDocuments;
    protected $qualificationDocuments;

    /**
     * @return mixed
     */
    public function getLotValues()
    {
        return $this->lotValues;
    }

    /**
     * @return mixed
     */
    public function getEligibilityDocuments()
    {
        return $this->eligibilityDocuments;
    }

    /**
     * @return mixed
     */
    public function getFinancialDocuments()
    {
        return $this->financialDocuments;
    }

    /**
     * @return mixed
     */
    public function getQualificationDocuments()
    {
        return $this->qualificationDocuments;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'lotValues' => 'app\entity\base\item\ItemEntity',
            'parameters' => 'app\entity\tender\bid\ParameterEntity',
            'eligibilityDocuments' => 'app\entity\base\DocumentEntity',
            'financialDocuments' => 'app\entity\base\DocumentEntity',
            'qualificationDocuments' => 'app\entity\base\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}