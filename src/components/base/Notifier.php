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

    /**
     * @param array|null $data
     * @param string $id
     * @return Check
     */
    protected function getEntityInfo(?array $data, string $id): Check
    {
        if (empty($data)) return new Check(null, true);
        foreach ($data as $entity) {
            if ($entity->getId() == $id) {
                return new Check($entity, false);
            }
        }
        return new Check(null, true);
    }
}