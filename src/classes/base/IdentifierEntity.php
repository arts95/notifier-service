<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class IdentifierEntity
 *
 * @package app\entity\base
 */
class IdentifierEntity extends BaseEntity
{
    protected $id;
    protected $scheme;
    protected $legalName;
    protected $uri;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

}