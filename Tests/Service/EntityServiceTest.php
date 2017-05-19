<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use RonteLtd\CommonBundle\Exception\EntityValidateException;
use RonteLtd\CommonBundle\Tests\Fixtures\LoadEntityData;
use RonteLtd\CommonBundle\Tests\Service\EntityService;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * EntityServiceTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityServiceTest extends WebTestCase
{
    /**
     * @var \RonteLtd\CommonBundle\Tests\Repository\EntityRepository
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
        $this->service = new EntityService($validator);
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
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::setRepository()
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::getRepository()
     */
    public function testGetSetRepository()
    {
        self::assertInstanceOf(EntityService::class, $this->service->setRepository($this->repository));
        self::assertEquals($this->repository, $this->service->getRepository());
    }

    /**
     * Tests validation exception
     *
     * @group entity_exception
     * @expectedException \RonteLtd\CommonBundle\Exception\EntityValidateException
     *
     */
    public function testValidationException()
    {
        $entity = new Entity();
        $this->service->validate($entity);
    }

    /**
     * Tests validation
     *
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::validate()
     *
     */
    public function testValidate()
    {
        $entity = new Entity();
        $result = $this->service->validate($entity->setFirstname('Vasia'));
        self::assertInstanceOf(Entity::class, $result);
    }

    /**
     * Tests saving an entity
     *
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::save()
     * @group entity_save
     */
    public function testSave()
    {
        $entity = new Entity();
        $entity->setFirstname('testFirstname');
        self::assertInstanceOf(Entity::class, $this->service->save($entity));
    }

    /**
     * Test remover for an entity
     *
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::remove()
     */
    public function testRemove()
    {
        $id = $this->fixtures->getReference('entity')->getId();
        $entity = $this->repository->find($id);
        self::assertInstanceOf(EntityService::class, $this->service->remove($entity));
    }

    /**
     * Tests paginate
     *
     * @covers \RonteLtd\CommonBundle\Tests\Service\EntityService::paginate()
     */
    public function testPaginate()
    {
        $qb =  $this->repository->createQueryBuilder('e');
        $query = $qb->getQuery();
        $result = $this->service->paginate($query);
        self::assertArrayHasKey('meta', $result);
        self::assertArrayHasKey('data', $result);
        self::assertInstanceOf(Paginator::class, $result['data']);
        self::assertEquals(1, $result['meta']['pages']);
        self::assertEquals(1, $result['meta']['total']);
    }
}