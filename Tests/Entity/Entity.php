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
use Doctrine\ORM\Mapping as ORM;
use RonteLtd\CommonBundle\Entity\CreatedAtTrait;
use RonteLtd\CommonBundle\Entity\UpdatedAtTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 *
 * @ORM\Entity(repositoryClass="EntityRepository")
 * @ORM\Table(name="t_entity")
 */
class Entity extends AbstractEntity
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     */
    private $firstname = '';

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
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