<?php

namespace RonteLtd\CommonBundle\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use RonteLtd\CommonBundle\Entity\BaseEntityInterface;
use RonteLtd\CommonBundle\Exception\EntityValidateException;
use RonteLtd\CommonBundle\Repository\AbstractBaseRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * AbstractBaseService
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractBaseService
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var AbstractBaseRepository
     */
    private $repository;

    /**
     * AbstractEntityService constructor.
     *
     * @param ValidatorInterface|null $validator
     */
    public function __construct(ValidatorInterface $validator = null)
    {
        $this->validator = $validator;
    }

    /**
     * Sets a repository
     *
     * @param AbstractBaseRepository $repository
     * @return AbstractBaseService
     */
    public function setRepository(AbstractBaseRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Gets a repository
     *
     * @return AbstractBaseRepository
     */
    public function getRepository(): AbstractBaseRepository
    {
        return $this->repository;
    }

    /**
     * Saves an entity
     *
     * @param BaseEntityInterface $entity
     * @param array $groups
     * @return BaseEntityInterface
     */
    public function save(BaseEntityInterface $entity, array $groups = [])
    {
        $result = $this->validate($entity, $groups);
        $this->getRepository()->save($result, true);

        return $result;
    }

    /**
     * Removes an entity
     *
     * @param BaseEntityInterface $entity
     * @return AbstractBaseService
     */
    public function remove(BaseEntityInterface $entity): self
    {
        $this->getRepository()->remove($entity, true);

        return $this;
    }

    /**
     * Validates
     *
     * @param BaseEntityInterface $entity
     * @param array $groups
     * @return BaseEntityInterface
     * @throws EntityValidateException
     */
    public function validate(BaseEntityInterface $entity, array $groups = [])
    {
        if ($this->validator) {
            $violations = $this->validator->validate($entity, null, $groups);

            if ($violations->count()) {
                throw new EntityValidateException('Validation error', $violations, 400);
            }
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
            'meta' => [
                'page' => $page,
                'total' => $totalItems,
                'pages' => $pagesCount,
                'limit' => $limit,
            ],
            'data' => $paginator
        ];
    }
}