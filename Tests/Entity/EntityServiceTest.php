<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * EntityServiceTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityServiceTest extends WebTestCase
{
    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    private $validator;

    /**
     * @var \RonteLtd\CommonBundle\Tests\Entity\EntityRepository
     */
    private $repository;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $client = self::createClient();
        $this->validator = $client->getContainer()->get('validator');
        $this->repository = $client
            ->getContainer()
            ->get('doctrine')
            ->getRepository('RonteLtd\CommonBundle\Tests\Entity\Entity');

        parent::setUp();
    }

    /**
     * Tests constructor
     */
    public function testConstruct()
    {
        self::assertInstanceOf(EntityService::class, new EntityService($this->validator));
    }

    /**
     * Tests setter and gettter of the EntityService
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::setRepository()
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::getRepository()
     */
    public function testGetSetRepository()
    {
        $service = new EntityService($this->validator);
        $service->setRepository($this->repository);
        self::assertEquals($this->repository, $service->getRepository());
    }

    /**
     * Test validate
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::validate()
     */
    public function testValidate()
    {
        $service = new EntityService($this->validator);
        $entity = new Entity();
        $result = $service->validate($entity);
        self::assertTrue(is_array($result));
        $result = $service->validate($entity->setFirstname('Vasia'));
        self::assertInstanceOf(Entity::class, $result);
    }
}