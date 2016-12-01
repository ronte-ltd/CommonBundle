<?php
/*
 * This file is part of CommonBundle the package.
 *
 * (c) Ruslan Muriev <muriev.r@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @return $this | EntityInterface
     */
    public function setCreatedAt(\DateTime $createdAt): EntityInterface
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