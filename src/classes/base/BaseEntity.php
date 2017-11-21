<?php

namespace app\entity\base;

use ReflectionClass;

/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */
abstract class BaseEntity
{
    public function __construct(array $data, ?string $key = null)
    {
        if ($key === null) {
            $this->load($data);
        } elseif (isset($data[$key])) {
            $this->load($data[$key]);
        }
    }

    protected function load($data): bool
    {
        if (!empty($data)) {
            $this->setAttributes($data);
            return true;
        }

        return false;
    }

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
                                $reflection = new ReflectionClass($class);
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

    protected function getClassNameByKey(string $key): ?string
    {
        return null;
    }

    private function isAssociative($array): bool
    {
        if (!is_array($array) || empty($array)) {
            return false;
        }

        foreach ($array as $key => $value) {
            if (!is_string($key)) {
                return false;
            }
        }

        return true;
    }
}