<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * EntityTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityTest extends WebTestCase
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
        parent::setUp();
        $this->entity = new Entity();
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
     * @covers \RonteLtd\CommonBundle\Tests\Entity\Entity::fromArray()
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
     * @covers \RonteLtd\CommonBundle\Tests\Entity\Entity::setCreatedAt()
     * @covers \RonteLtd\CommonBundle\Tests\Entity\Entity::getCreatedAt()
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
     * @covers  \RonteLtd\CommonBundle\Tests\Entity\Entity::setUpdatedAt()
     * @covers  \RonteLtd\CommonBundle\Tests\Entity\Entity::getUpdatedAt()
     */
    public function testSetGetUpdatedAt()
    {
        $datetime = new \DateTime();
        self::assertInstanceOf(Entity::class, $this->entity->setUpdatedAt($datetime));
        self::assertEquals($datetime, $this->entity->getUpdatedAt());
    }
}