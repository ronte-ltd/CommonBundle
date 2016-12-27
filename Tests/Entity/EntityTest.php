<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

/**
 * EntityTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $data;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->data = [
            'firstname' => 'Vasya',
            'lastname' => 'Pupkin'
        ];

        parent::setUp();
    }

    /**
     * Tests construct
     */
    public function testConstruct()
    {
        $entity = new Entity($this->data);
        self::assertInstanceOf(Entity::class, $entity);
    }

    /**
     * Tests FromArray
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\Entity::fromArray()
     */
    public function testFromArray()
    {
        $entity = new Entity([]);
        $entity->fromArray($this->data);
        self::assertEquals('Vasya', $entity->getFirstname());
        self::assertNotEquals('Pupkin', $entity->getLastname());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetCreatedAt()
    {
        $entity = new Entity();
        $datetime = new \DateTime();
        $entity->setCreatedAt($datetime);
        self::assertEquals($datetime, $entity->getCreatedAt());
    }

    /**
     * Test setter and getter for createdAt
     */
    public function testSetGetUpdatedAt()
    {
        $entity = new Entity();
        $datetime = new \DateTime();
        $entity->setUpdatedAt($datetime);
        self::assertEquals($datetime, $entity->getUpdatedAt());
    }
}