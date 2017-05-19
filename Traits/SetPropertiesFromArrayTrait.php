<?php

namespace RonteLtd\CommonBundle\Traits;

/**
 * SetPropertiesFromArrayTrait
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
trait SetPropertiesFromArrayTrait
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return SetPropertiesFromArrayTrait
     */
    final public function fromArray(Array $data): self
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