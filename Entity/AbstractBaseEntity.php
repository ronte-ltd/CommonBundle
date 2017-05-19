<?php

namespace RonteLtd\CommonBundle\Entity;

use RonteLtd\CommonBundle\Traits\SetPropertiesFromArrayTrait;

/**
 * AbstractBaseEntity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractBaseEntity implements BaseEntityInterface
{
    use SetPropertiesFromArrayTrait;

    /**
     * Constructs an object
     *
     * AbstractEntity constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->fromArray($data);
        }
    }
}