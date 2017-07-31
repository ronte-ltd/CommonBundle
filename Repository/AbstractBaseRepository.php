<?php

namespace RonteLtd\CommonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use RonteLtd\CommonBundle\Entity\BaseEntityInterface;

/**
 * AbstractBaseRepository
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractBaseRepository extends EntityRepository
{
    /**
     * @var int
     */
    protected $lifetime;

    /**
     * Sets lifetime
     *
     * @param int $lifetime
     * @return AbstractBaseRepository
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }

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

    /**
     * Gets cached query
     *
     * @param Query $query
     * @param string|null $resultCacheId
     * @param int|null $lifetime
     * @return Query
     */
    public function getCachedQuery(Query &$query, string $resultCacheId = null, int $lifetime = null): Query
    {
        return $query
            ->useQueryCache(true)
            ->useResultCache(true, $lifetime ?? $this->lifetime, $resultCacheId);
    }

    /**
     * Gets cached query from dql
     *
     * @param string $dql
     * @param string|null $resultCacheId
     * @param int|null $lifetime
     * @return Query
     */
    public function getCachedQueryFromDql(string $dql, string $resultCacheId = null, int $lifetime = null): Query
    {
        $query = $this->_em->createQuery($dql);

        return $this->getCachedQuery($query, $resultCacheId, $lifetime ?? $this->lifetime);
    }

    /**
     * Removes query results from cache by result cache id
     *
     * @param string $resultCacheId
     * @return bool
     */
    public function flushResultCache(string $resultCacheId): bool
    {
        $cacheDriver = $this->_em->getConfiguration()->getResultCacheImpl();

        return $cacheDriver->delete($resultCacheId);
    }
}