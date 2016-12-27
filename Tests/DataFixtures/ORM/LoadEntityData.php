<?php
/*
 * This file is part of jsonapi the package.
 *
 * (c) Alexey Astafev <efsneiron@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->addReference('entity', $entity);
        $manager->flush();
    }
}