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

/**
 * EntityRepositoryInterface
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
interface EntityRepositoryInterface
{
    /**
     * Saves an entity
     *
     * @param EntityInterface $entity
     * @param bool|false $flush
     * @return EntityInterface
     */
    public function save(EntityInterface $entity, $flush = true): EntityInterface;
    /**
     * Removes an entity
     *
     * @param EntityInterface $entity
     * @param bool|false $flush
     * @return EntityInterface
     */
    public function remove(EntityInterface $entity, $flush = true): EntityInterface;
}