<?php

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use RonteLtd\CommonBundle\Event\EntityEvent;
use RonteLtd\CommonBundle\Exception\EntityValidateException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * EntityService
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntityService
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var AbstractEntityRepository
     */
    protected $repository;

    /**
     * AbstractEntityService constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Sets a repository
     *
     * @param AbstractEntityRepository $repository
     * @return AbstractEntityService
     */
    public function setRepository(AbstractEntityRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Gets a repository
     *
     * @return AbstractEntityRepository
     */
    public function getRepository(): AbstractEntityRepository
    {
        return $this->repository;
    }

    /**
     * Saves an entity
     *
     * @param EntityInterface $entity
     * @param array $groups
     * @return EntityInterface
     */
    public function save(EntityInterface $entity, array $groups = [])
    {
        $result = $this->validate($entity, $groups);
        $this->getRepository()->save($result, true);

        return $result;
    }

    /**
     * Removes an entity
     *
     * @param EntityInterface $entity
     * @return AbstractEntityService
     */
    public function remove(EntityInterface $entity): self
    {
        $this->getRepository()->remove($entity, true);

        return $this;
    }

    /**
     * Validates
     *
     * @param EntityInterface $entity
     * @param array $groups
     * @return EntityInterface
     * @throws EntityValidateException
     */
    public function validate(EntityInterface $entity, array $groups = [])
    {
        $violations = $this->validator->validate($entity, null, $groups);

        if ($violations->count()) {
            throw new EntityValidateException('Validation error', $violations, 400);
        }

        return $entity;
    }

    /**
     * Paginates a query
     *
     * @param Query $query
     * @param int $page
     * @param int $limit
     * @param bool $fetchJoinCollection
     * @return array
     */
    public function paginate(Query $query, $page = 1, $limit = 10, $fetchJoinCollection = false): array
    {
        $paginator = new Paginator($query, $fetchJoinCollection);
        $totalItems = $paginator->count();
        $pagesCount = ceil($totalItems / $limit);
        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))// offset
            ->setMaxResults($limit); // limit

        return [
            'page' => $page,
            'total' => $totalItems,
            'pages' => $pagesCount,
            'limit' => $limit,
            'data' => $paginator
        ];
    }
}