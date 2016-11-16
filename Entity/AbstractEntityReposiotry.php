<?php

/*
 * This file is part of CommonBundle the package.
 *
 * (c) Alexey Astafev <efsneiron@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AbstractEntityReposiotry
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntityReposiotry extends EntityRepository implements EntityRepositoryInterface
{
    /**
     * @inheritdoc
     */
    final public function save(EntityInterface $entity, $flush = true): EntityInterface
    {
        $this->_em->persist($entity);

        if (true === $flush) {
            $this->_em->flush();
        }

        return $entity;
    }

    /**
     * @inheritdoc
     */
    final public function remove(EntityInterface $entity, $flush = true): EntityInterface
    {
        $this->_em->remove($entity);

        if (true === $flush) {
            $this->_em->flush();
        }

        return $entity;
    }
}