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
		$this->guest     = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @param $name
	 *
	 * @return Tag
	 */
	public function setName($name): Tag
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param Guest $guest
	 *
	 * @return Tag
	 */
	public function addGuest(Guest $guest): Tag
	{
		$this->guest[] = $guest;

		return $this;
	}

	/**
	 * @param Guest $guest
	 */
	public function removeGuest(Guest $guest)
	{
		$this->guest->removeElement($guest);
	}

	/**
	 * @return ArrayCollection
	 */
	public function getGuest(): ArrayCollection
	{
		return $this->guest;
	}

	/**
	 * @param Event|null $event
	 *
	 * @return Tag
	 */
	public function setEvent(Event $event = null): Tag
	{
		$this->event = $event;

		return $this;
	}

	/**
	 * @return Event|null
	 */
	public function getEvent(): ?Event
	{
		return $this->event;
	}
}
