<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


class IdentifierEntity extends BaseEntity
{
    protected $id;
    protected $scheme;
    protected $legalName;
    protected $uri;
}