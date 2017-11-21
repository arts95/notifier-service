<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


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
    protected $confidentiality;
}