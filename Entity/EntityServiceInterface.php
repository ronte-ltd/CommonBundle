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
 * EntityServiceInterface
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
interface EntityServiceInterface
{
    /**
     * Constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator);

    /**
     * Sets a repository
     *
     * @param EntityRepositoryInterface $repository
     * @return EntityServiceInterface
     */
    public function setRepository(EntityRepositoryInterface $repository): EntityServiceInterface;

    /**
     * Gets a repository
     *
     * @return EntityRepositoryInterface
     */
    public function getRepository(): EntityRepositoryInterface;

    /**
     * Validates an entity
     *
     * @param EntityInterface $entity
     * @return array|EntityInterface
     */
    public function validate(EntityInterface $entity);
}