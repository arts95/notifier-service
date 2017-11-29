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
        $this->load($this->getDataByKey($data, $key));
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
                if (isset($attributes[$name]) && $this->{$name} === null) {
                    if (is_array($value) && !$this->isAssociative($value)) {
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

    /**
     * @param string $key
     * @return null|string
     */
    protected function getClassNameByKey(string $key): ?string
    {
        return null;
    }

    /**
     * @param array $data
     * @param null|string $key
     * @return array
     * @throws \Exception
     */
    protected function getDataByKey(array $data, ?string $key): array
    {
        if ($key !== null) {
            if (isset($data[$key])) {
                return $data[$key];
            }
//            else {
//                throw new \Exception("Key '{$key}' doesn't exist.");
//            }
        }
        return $data;
    }
}