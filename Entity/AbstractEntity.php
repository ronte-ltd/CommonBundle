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
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return EntityInterface
     */
    final public function fromArray(Array $data = []): EntityInterface
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }
}