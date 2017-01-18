<?php

namespace Tests\AppBundle\Event;

use RonteLtd\CommonBundle\Event\EntityEvent;
use RonteLtd\CommonBundle\Tests\Entity\Entity;

/**
 * EntityEventTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests construct and getter for an entity
     */
    public function testConstructAndGetItem()
    {
        $entity = new Entity();
        $event = new EntityEvent($entity);
        self::assertInstanceOf(EntityEvent::class, $event);
        self::assertEquals($entity, $event->getEntity());
    }
}