<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class OrganizationEntity
 *
 * @package app\entity\base
 */
class OrganizationEntity extends BaseEntity
{
    protected $name;
    protected $identifier;
    protected $address;
    protected $additionalIdentifiers;
    protected $contactPoint;
    protected $additionalContactPoints;
    protected $kind;

    /**
     * OrganizationEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);

        $this->contactPoint = new ContactPoint($data, 'contactPoint');
        $this->identifier = new IdentifierEntity($data, 'identifier');
        $this->address = new AddressEntity($data, 'address');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return IdentifierEntity
     */
    public function getIdentifier(): IdentifierEntity
    {
        return $this->identifier;
    }

    /**
     * @return AddressEntity
     */
    public function getAddress(): AddressEntity
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getAdditionalIdentifiers()
    {
        return $this->additionalIdentifiers;
    }

    /**
     * @return ContactPoint
     */
    public function getContactPoint(): ContactPoint
    {
        return $this->contactPoint;
    }

    /**
     * @return mixed
     */
    public function getAdditionalContactPoints()
    {
        return $this->additionalContactPoints;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getClassNameByKey($key): ?string
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