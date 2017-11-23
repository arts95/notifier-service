<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class DocumentEntity
 *
 * @package app\entity\base
 */
class DocumentEntity extends BaseEntity
{
    protected $id;
    protected $documentType;
    protected $title;
    protected $description;
    protected $format;
    protected $url;
    protected $datePublished;
    protected $dateModified;
    protected $language;
    protected $documentOf;
    protected $relatedItem;
    protected $realName;
    protected $author;
    protected $isDescriptionDecision;

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
    public function getDocumentType()
    {
        return $this->documentType;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getDocumentOf()
    {
        return $this->documentOf;
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
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getisDescriptionDecision()
    {
        return $this->isDescriptionDecision;
    }
}