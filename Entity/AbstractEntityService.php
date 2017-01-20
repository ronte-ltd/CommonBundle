<?php

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use RonteLtd\CommonBundle\Event\EntityEvent;
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
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var AbstractEntityRepository
     */
    protected $repository;

    /**
     * AbstractEntityService constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator, EventDispatcherInterface $dispatcher = null)
    {
        $this->validator = $validator;
        $this->dispatcher = $dispatcher;
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

        if (!($result instanceof EntityError)) {
            $this->getRepository()->save($result, true);
        }

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
     */
    public function validate(EntityInterface $entity, array $groups = [])
    {
        $result = $this->validator->validate($entity, null, $groups);
        $errors = new EntityError();

        foreach ($result as $r) {
            $errors->addErrors($r->getPropertyPath(), $r->getMessage());
        }

        if ($this->dispatcher) {
            if ($errors->getErrors()) {
                $this->dispatcher->dispatch(EntityEvent::ERROR, new EntityEvent($errors));
            } else {
                $this->dispatcher->dispatch(EntityEvent::SUCCESS, new EntityEvent($entity));
            }
        }

        return $errors->getErrors() ? $errors : $entity;
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
            ->setFirstResult($limit * ($page - 1)) // offset
            ->setMaxResults($limit); // limit

        return [
            'total' => $totalItems,
            'pages' => $pagesCount,
            'data' => $paginator
        ];
    }
}