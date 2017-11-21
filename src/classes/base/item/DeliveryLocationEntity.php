<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 17.11.17
 */

namespace app\entity\base\item;

use app\entity\base\BaseEntity;

class DeliveryLocationEntity extends BaseEntity
{
    protected $latitude;
    protected $longitude;
    protected $elevation;
}