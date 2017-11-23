<?php

namespace app\entity\base;

use ReflectionClass;

/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */
abstract class BaseEntity
{
    /**
     * BaseEntity constructor.
     *
     * @param array $data
     * @param null|string $key
     */
    public function __construct(array $data, ?string $key = null)
    {
        if ($key === null) {
            $this->load($data);
        } elseif (isset($data[$key])) {
            $this->load($data[$key]);
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function load(array $data): bool
    {
        if (!empty($data)) {
            $this->setAttributes($data);
            return true;
        }

        return false;
    }

    /**
     * @param array $values
     */
    protected function setAttributes(array $values): void
    {
        if (is_array($values)) {
            $attributes = $this->getAttributes();
            $attributes = array_flip($attributes);
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    if (is_array($value)) {
                        if (($class = $this->getClassNameByKey($name)) !== null) {
                            foreach ($values[$name] as $key => $objData) {
                                $obj = new $class($objData);
                                $value[$key] = $obj;
                            }
                        }
                    }
                    $this->$name = $value;
                }
            }

        }
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties() as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }
        return $names;
    }

    /**
     * @param string $key
     * @return null|string
     */
    protected function getClassNameByKey(string $key): ?string
    {
        return $key;
    }
}