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
    const SUCCESS = 'ronteltd.common.validation.success';
    const ERROR = 'ronteltd.common.validation.error';

    /**
     * @var EntityInterface|array
     */
    private $entity;

    /**
     * EntityEvent constructor.
     * @param $entity
     */
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