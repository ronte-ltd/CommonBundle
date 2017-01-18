<?php

namespace RonteLtd\CommonBundle\Tests\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RonteLtd\CommonBundle\Tests\Entity\Entity;

class LoadEntityData extends AbstractFixture implements FixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $entity = new Entity([
            'firstname' => 'Vasia'
        ]);

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('entity', $entity);
    }
}