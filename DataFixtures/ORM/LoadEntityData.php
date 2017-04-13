<?php

namespace RonteLtd\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use RonteLtd\CommonBundle\DataFixtures\AbstractBaseFixture;
use RonteLtd\CommonBundle\Entity\Test\Entity;

/**
 * LoadEntityData
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class LoadEntityData extends AbstractBaseFixture
{
    /**
     * Performs the actual fixtures loading.
     *
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     * @param ObjectManager $manager The object manager.
     */
    protected function doLoad(ObjectManager $manager): void
    {
        $entity = new Entity([
            'firstname' => 'Vasia'
        ]);

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('entity', $entity);
    }

    /**
     * Returns the list of environments.
     *
     * @return array The name of the environments.
     */
    protected function getEnvironments(): array
    {
        return ['test'];
    }
}