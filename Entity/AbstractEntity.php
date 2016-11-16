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
 * AbstractEntity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
abstract class AbstractEntity implements EntityInterface
{
    use EntityTrait;

    /**
     * Constructs an object
     *
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fromArray($data);
    }
}