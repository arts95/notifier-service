<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;

class ClassificationEntity extends BaseEntity
{
    protected $id;
    protected $description;
    protected $scheme;
    protected $uri;
}