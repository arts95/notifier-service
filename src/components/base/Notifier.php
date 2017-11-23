<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\base;


abstract class Notifier
{
    public function notify(object $object): bool
    {
        /** @todo make email, cabinet, phone notify */
        return true;
    }
}