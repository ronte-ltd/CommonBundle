<?php

namespace RonteLtd\CommonBundle\Entity;

/**
 * EntityError
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
final class EntityError
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * Adds some errors
     *
     * @param $key
     * @param $value
     * @return EntityError
     */
    public function addErrors($key, $value): self
    {
        $this->errors[$key] = $value;

        return $this;
    }

    /**
     * Gets errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}