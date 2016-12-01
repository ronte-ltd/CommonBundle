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
     * @return $this | EntityInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt): EntityInterface
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}