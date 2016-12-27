<?php

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AbstractEntityRepository
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntityRepository extends EntityRepository
{
    /**
     * Saves an entity
     *
     * @param EntityInterface $entity
     * @param bool $flush
     * @return AbstractEntityRepository
     */
    final public function save(EntityInterface $entity, $flush = false): self
    {
        $this->_em->persist($entity);

        if (true === $flush) {
            $this->_em->flush();
        }

        return $this;
    }

    /**
     * Removes an entity
     *
     * @param EntityInterface $entity
     * @param bool $flush
     * @return AbstractEntityRepository
     */
    final public function remove(EntityInterface $entity, $flush = false): self
    {
        $this->_em->remove($entity);

        if (true === $flush) {
            $this->_em->flush();
        }

        return $this;
    }
}