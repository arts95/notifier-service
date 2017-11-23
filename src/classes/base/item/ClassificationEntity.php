<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;

/**
 * Class ClassificationEntity
 *
 * @package app\entity\base\item
 */
class ClassificationEntity extends BaseEntity
{
    protected $id;
    protected $description;
    protected $scheme;
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
    public function getDescription()
    {
        return $this->description;
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
    public function getUri()
    {
        return $this->uri;
    }
}