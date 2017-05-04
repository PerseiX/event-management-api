<?php

namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\ActiveTrait;
use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use Doctrine\Common\Collections\ArrayCollection;
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
	 * @ORM\OneToMany(targetEntity="EventManagementBundle\Entity\Guest", mappedBy="tag")
	 */
	protected $guest;

	/**
	 * @ORM\ManyToOne(targetEntity="EventManagementBundle\Entity\Event", inversedBy="tag")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $event;

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

	/**
	 * @param mixed $event
	 *
	 * @return Tag
	 */
	public function setEvent($event)
	{
		$this->event = $event;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEvent()
	{
		return $this->event;
	}
}