<?php

namespace RonteLtd\CommonBundle\Event;

use RonteLtd\CommonBundle\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * ValidatorEvent
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityEvent extends Event
{
    const SUCCESS = 'ronteld.common.validation.success';
    const ERROR = 'ronteld.common.validation.error';

    /**
     * @var EntityInterface|array
     */
    private $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Gets an entity
     *
     * @return EntityInterface|array
     */
    public function getEntity()
    {
        return $this->entity;
    }
}