<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use RonteLtd\CommonBundle\Entity\EntityError;
use RonteLtd\CommonBundle\Tests\DataFixtures\ORM\LoadEntityData;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * EntityServiceTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityServiceTest extends WebTestCase
{
    /**
     * @var \RonteLtd\CommonBundle\Tests\Entity\EntityRepository
     */
    private $repository;

    /**
     * @var EntityService
     */
    private $service;

    /**
     * @var \Doctrine\Common\DataFixtures\ReferenceRepository
     */
    private $fixtures;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $client = self::createClient();
        $validator = $client->getContainer()->get('validator');
        $this->service = new EntityService($validator, new EventDispatcher());
        $this->fixtures = $this->loadFixtures([
            LoadEntityData::class
        ])->getReferenceRepository();
        $this->repository = $client
            ->getContainer()
            ->get('doctrine')
            ->getRepository(Entity::class);
        $this->service->setRepository($this->repository);

        parent::setUp();
    }

    /**
     * Tests setter and gettter of the EntityService
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::setRepository()
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::getRepository()
     */
    public function testGetSetRepository()
    {
        $this->service->setRepository($this->repository);
        self::assertEquals($this->repository, $this->service->getRepository());
    }

    /**
     * Test validate
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::validate()
     */
    public function testValidate()
    {
        $entity = new Entity();
        $result = $this->service->validate($entity);
        self::assertInstanceOf(EntityError::class, $result);
        $result = $this->service->validate($entity->setFirstname('Vasia'));
        self::assertInstanceOf(Entity::class, $result);
    }

    /**
     * Tests saving an entity
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::save()
     */
    public function testSave()
    {
        $entity = new Entity();
        $result = $this->service->save($entity);
        self::assertInstanceOf(EntityError::class, $result);
        $entity->setFirstname('testFirstname');
        self::assertInstanceOf(EntityError::class, $result);
    }

    /**
     * Test remover for an entity
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::remove()
     */
    public function testRemove()
    {
        $id = $this->fixtures->getReference('entity')->getId();
        $entity = $this->repository->find($id);
        $this->service->remove($entity);
    }

    /**
     * Tests paginate
     *
     * @covers \RonteLtd\CommonBundle\Tests\Entity\EntityService::paginate()
     */
    public function testPaginate()
    {
        $qb =  $this->repository->createQueryBuilder('e');
        $query = $qb->getQuery();
        $result = $this->service->paginate($query);
        self::assertEquals(1, $result['pages']);
        self::assertEquals(1, $result['total']);
        self::assertInstanceOf(Paginator::class, $result['data']);
    }
}