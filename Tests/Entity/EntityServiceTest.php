<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use RonteLtd\CommonBundle\DataFixtures\ORM\LoadEntityData;
use RonteLtd\CommonBundle\Entity\Test\Entity;
use RonteLtd\CommonBundle\Entity\Test\EntityService;
use RonteLtd\CommonBundle\Exception\EntityValidateException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * EntityServiceTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 * @group entity_service
 */
class EntityServiceTest extends WebTestCase
{
    /**
     * @var \RonteLtd\CommonBundle\Entity\Test\EntityRepository
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
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::setRepository()
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::getRepository()
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
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::validate()
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
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::save()
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
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::remove()
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
     * @covers \RonteLtd\CommonBundle\Entity\Test\EntityService::paginate()
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