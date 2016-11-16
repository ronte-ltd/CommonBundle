<?php

/*
 * This file is part of CommonBundle the package.
 *
 * (c) Alexey Astafev <efsneiron@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RonteLtd\CommonBundle\Tests\Entity;

use RonteLtd\CommonBundle\Entity\AbstractEntity;
use RonteLtd\CommonBundle\Entity\EntityTrait;

/**
 * Entity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
class Entity extends AbstractEntity
{
    /**
     * @var string
     */
    private $firstname = '';

    /**
     * @var string
     */
    private $lastname = '';

    /**
     * Gets firstname
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Sets firstname
     *
     * @param string $firstname
     * @return Entity
     */
    public function setFirstname(string $firstname): Entity
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets first name
     *
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }
}