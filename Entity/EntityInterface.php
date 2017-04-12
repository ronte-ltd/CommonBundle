<?php

namespace RonteLtd\CommonBundle\Entity;

/**
 * EntityInterface
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
interface EntityInterface
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return EntityInterface
     */
    public function fromArray(Array $data = []);

    /**
     * Gets some defined data in array
     *
     * @return array
     */
    public function toArray(): array;
}