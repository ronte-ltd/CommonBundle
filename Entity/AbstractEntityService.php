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

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * EntityService
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntityService implements EntityServiceInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EntityRepositoryInterface
     */
    private $repository;

    /**
     * @inheritdoc
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function setRepository(EntityRepositoryInterface $repository): EntityServiceInterface
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRepository(): EntityRepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @inheritdoc
     */
    final public function validate(EntityInterface $entity)
    {
        $result = $this->validator->validate($entity);
        $errors = [];

        foreach ($result as $r) {
            $errors[$r->getPropertyPath()] = $r->getMessage();
        }

        return $errors ?: $entity;
    }
}