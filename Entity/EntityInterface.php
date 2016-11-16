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
 * EntityInterface
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
interface EntityInterface
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return EntityInterface
     */
    public function fromArray(Array $data = []): EntityInterface;
}