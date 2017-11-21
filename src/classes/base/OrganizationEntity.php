<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


class OrganizationEntity extends BaseEntity
{
    protected $name;
    protected $identifier;
    protected $address;
    protected $additionalIdentifiers;
    protected $contactPoint;
    protected $additionalContactPoints;
    protected $kind;

    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->contactPoint = new ContactPoint($data, 'contactPoint');
        $this->identifier = new IdentifierEntity($data, 'identifier');
        $this->address = new AddressEntity($data, 'address');
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getClassNameByKey($key)
    {
        $mapper = [
            'additionalContactPoints' => 'app\entity\base\ContactPointEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }
}