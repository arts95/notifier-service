<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 22.11.17
 */

namespace app\entity\tender\feature;


use app\entity\base\BaseEntity;

/**
 * Class EnumEntity
 *
 * @package app\entity\tender\feature
 */
class EnumEntity extends BaseEntity
{
    protected $value;
    protected $title;
    protected $title_en;
    protected $description;

    /**
     * @return mixed
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitleEn(): string
    {
        return $this->title_en;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}