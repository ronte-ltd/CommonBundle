<?php

namespace RonteLtd\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * UpdatedAtTrait
 *
 * @author Alexey Astafev <efsneiron@gmail.com>
 */
trait UpdatedAtTrait
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * Gets UpdatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Sets UpdatedAt
     *
     * @param \DateTime $updatedAt
     * @return UpdatedAtTrait
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}