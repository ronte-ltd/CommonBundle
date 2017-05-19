<?php

namespace RonteLtd\CommonBundle\Entity;

/**
 * BaseEntityInterface
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
interface BaseEntityInterface
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return BaseEntityInterface
     */
    public function fromArray(Array $data);
}