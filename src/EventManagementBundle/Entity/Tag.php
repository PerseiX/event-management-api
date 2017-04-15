<?php

namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\ActiveTrait;
use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 * @package EventManagementBundle\Entity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EventManagementBundle\Entity\Repository\TagRepository")
 */
class Tag
{
	use IDTrait;
	use ActiveTrait;
	use CreatedAtTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=128)
	 */
	protected $name;

	/**
	 * Tag constructor.
	 */
	public function __construct()
	{
		$this->active    = true;
		$this->createdAt = new \DateTime();
	}

	/**
	 * @return string
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return Tag
	 */
	public function setName(string $name): Tag
	{
		$this->name = $name;

		return $this;
	}
}