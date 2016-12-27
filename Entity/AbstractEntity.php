<?php

namespace RonteLtd\CommonBundle\Entity;

/**
 * AbstractEntity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntity implements EntityInterface
{
    use EntityTrait;

    /**
     * Constructs an object
     *
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fromArray($data);
    }
}