<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\base;


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

    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->value = new ValueEntity($data, 'value');
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