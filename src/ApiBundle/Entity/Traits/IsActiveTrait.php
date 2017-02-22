<?php

namespace ApiBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class IsActiveTrait
 * @package ApiBundle\Entity\Traits
 */
trait IsActiveTrait
{
	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default" = true})
	 */
	protected $isActive;

	/**
	 * @return bool
	 */
	public function getIsActive(): ?bool
	{
		return $this->isActive;
	}

	/**
	 * @param bool $isActive
	 *
	 * @return $this
	 */
	public function setIsActive(bool $isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}
}