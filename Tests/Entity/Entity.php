<?php

namespace RonteLtd\CommonBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use RonteLtd\CommonBundle\Entity\AbstractEntity;
use RonteLtd\CommonBundle\Entity\CreatedAtTrait;
use RonteLtd\CommonBundle\Entity\UpdatedAtTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 *
 * @ORM\Entity(repositoryClass="RonteLtd\CommonBundle\Tests\Repository\EntityRepository")
 * @ORM\Table(name="entity")
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
    private $firstname;

    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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
    private $lastname;

    /**
     * Gets firstname
     *
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Sets firstname
     *
     * @param string $firstname
     * @return Entity
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets first name
     *
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Gets some defined data in array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }
}