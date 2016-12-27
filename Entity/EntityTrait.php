<?php

namespace RonteLtd\CommonBundle\Entity;

/**
 * EntityTrait
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
trait EntityTrait
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return EntityTrait
     */
    final public function fromArray(Array $data = []): self
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }
}