<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use RonteLtd\CommonBundle\Tests\Fixtures\LoadEntityData;

/**
 * EntityRepositoryTest
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class EntityRepositoryTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    /**
     * @var \RonteLtd\CommonBundle\Tests\Repository\EntityRepository
     */
    private $repository;

    /**
     * @var \Doctrine\Common\DataFixtures\ReferenceRepository
     */
    private $fixtures;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->repository = $this->client
            ->getContainer()
            ->get('doctrine')
            ->getRepository(Entity::class);
        $this->fixtures = $this->loadFixtures(array(
            LoadEntityData::class
        ))->getReferenceRepository();

        parent::setUp();
    }

    /**
     * Tests save
     *
     * @covers \RonteLtd\CommonBundle\Tests\Repository\EntityRepository::save()
     * @group repository_save
     */
    public function testSave()
    {
        $entity = $this->fixtures->getReference('entity');
        $entity->setFirstname('ipman');
        $this->repository->save($entity, true);
        self::assertEquals('ipman', $entity->getFirstname());
    }

    /**
     * Tests remove
     *
     * @covers \RonteLtd\CommonBundle\Tests\Repository\EntityRepository::remove()
     */
    public function testRemove()
    {
        $entityRef = $this->fixtures->getReference('entity');
        $entity = $this->repository->find($entityRef->getId());
        $this->repository->remove($entity, true);
        self::assertNull($this->repository->find($entityRef->getId()));
    }
}