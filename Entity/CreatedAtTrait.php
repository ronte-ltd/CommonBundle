<?php

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait CreatedAtTrait
 *
 * @package AppBundle\Traits\Entity
 * @author Ruslan Muriev <muriev.r@gmail.com>
 */
trait CreatedAtTrait
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Sets createdAt
     *
     * @param \DateTime $createdAt
     * @return CreatedAtTrait
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}