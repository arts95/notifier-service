<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender\feature;


use app\entity\base\BaseEntity;

/**
 * Class FeatureEntity
 *
 * @package app\entity\tender\feature
 */
class FeatureEntity extends BaseEntity
{
    protected $code;
    protected $featureOf;
    protected $relatedItem;
    protected $title;
    protected $title_en;
    protected $description;
    protected $description_en;
    protected $enum;

    /**
     * FeatureEntity constructor.
     *
     * @param array $data
     * @param null $key
     */
    public function __construct(array $data, $key = null)
    {
        parent::__construct($data, $key);
        $data = $this->getDataByKey($data, $key);
        $this->enum = new EnumEntity($data, 'enum');
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getFeatureOf()
    {
        return $this->featureOf;
    }

    /**
     * @return mixed
     */
    public function getRelatedItem()
    {
        return $this->relatedItem;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getTitleEn()
    {
        return $this->title_en;
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
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * @return EnumEntity
     */
    public function getEnum(): EnumEntity
    {
        return $this->enum;
    }


}