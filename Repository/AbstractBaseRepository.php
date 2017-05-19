<?php

namespace RonteLtd\CommonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use RonteLtd\CommonBundle\Entity\BaseEntityInterface;

/**
 * AbstractBaseRepository
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractBaseRepository extends EntityRepository
{
    /**
     * Saves an entity
     *
     * @param BaseEntityInterface $entity
     * @param bool $flush
     * @return AbstractBaseRepository
     */
    final public function save(BaseEntityInterface $entity, $flush = false): self
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
     * @param BaseEntityInterface $entity
     * @param bool $flush
     * @return AbstractBaseRepository
     */
    final public function remove(BaseEntityInterface $entity, $flush = false): self
    {
        $this->_em->remove($entity);

        if (true === $flush) {
            $this->_em->flush();
        }

        return $this;
    }
}