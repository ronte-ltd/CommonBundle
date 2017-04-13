<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use RonteLtd\CommonBundle\Entity\Test\Entity;

/**
 * EntityTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 * @group entity
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Entity
     */
    private $entity;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->entity = new Entity();
        parent::setUp();
    }

    /**
     * Tests construct
     *
     * @group entity
     */
    public function testConstruct()
    {
        $entity = new Entity([]);
        self::assertInstanceOf(Entity::class, $entity);
    }

    /**
     * Tests FromArray
     *
     * @covers \RonteLtd\CommonBundle\Entity\Test\Entity::fromArray()
     */
    public function testFromArray()
    {
        $data = [
            'firstname' => 'Vasia',
            'lastname' => 'Pupkin',
        ];
        $this->entity->fromArray($data);
        self::assertEquals($data['firstname'], $this->entity->getFirstname());
        self::assertNotEquals($data['lastname'], $this->entity->getLastname());
    }

    /**
     * Test setter and getter for createdAt
     *
     * @covers \RonteLtd\CommonBundle\Entity\Test\Entity::setCreatedAt()
     * @covers \RonteLtd\CommonBundle\Entity\Test\Entity::getCreatedAt()
     */
    public function testSetGetCreatedAt()
    {
        $datetime = new \DateTime();
        self::assertInstanceOf(Entity::class, $this->entity->setCreatedAt($datetime));
        self::assertEquals($datetime, $this->entity->getCreatedAt());
    }

    /**
     * Test setter and getter for updatedAt
     *
     * @covers  \RonteLtd\CommonBundle\Entity\Test\Entity::setUpdatedAt()
     * @covers  \RonteLtd\CommonBundle\Entity\Test\Entity::getUpdatedAt()
     */
    public function testSetGetUpdatedAt()
    {
        $datetime = new \DateTime();
        self::assertInstanceOf(Entity::class, $this->entity->setUpdatedAt($datetime));
        self::assertEquals($datetime, $this->entity->getUpdatedAt());
    }
}