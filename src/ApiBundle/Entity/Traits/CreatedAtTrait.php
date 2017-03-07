<?php

namespace ApiBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CreatedAtTrait
 * @package ApiBundle\Entity\Traits
 */
trait CreatedAtTrait
{
	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $createdAt;

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): ?\DateTime
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTime $createdAt
	 *
	 * @return $this
	 */
	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

}