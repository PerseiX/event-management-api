<?php
declare(strict_types=1);

namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use ApiBundle\Entity\Traits\ActiveTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\Traits\UserTrait;

/**
 * Class Event
 * @package EventManagementBundle\Entity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EventManagementBundle\Entity\Repository\EventRepository")
 */
class Event
{
	use IDTrait;
	use ActiveTrait;
	use CreatedAtTrait;
	use UserTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=256)
	 */
	protected $name;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=false)
	 */
	protected $eventTerm;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $description;

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="EventManagementBundle\Entity\Guest", mappedBy="event")
	 */
	protected $guest;

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="EventManagementBundle\Entity\Tag", mappedBy="event")
	 */
	protected $tag;

	/**
	 * @var float
	 *
	 * @ORM\Column(type="float")
	 */
	protected $longitude;

	/**
	 * @var float
	 *
	 * @ORM\Column(type="float")
	 */
	protected $latitude;

	/**
	 * Event constructor.
	 */
	public function __construct()
	{
		$this->createdAt = new \DateTime();
		$this->active    = false;
		$this->guest     = new ArrayCollection();
		$this->tag       = new ArrayCollection();
	}

	/**
	 * @return string
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 *
	 * @return Event
	 */
	public function setDescription(string $description = null): Event
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getEventTerm(): ?\DateTime
	{
		return $this->eventTerm;
	}

	/**
	 * @param \DateTime|null $eventTerm
	 *
	 * @return Event
	 */
	public function setEventTerm(\DateTime $eventTerm = null): Event
	{
		$this->eventTerm = $eventTerm;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string|null $name
	 *
	 * @return Event
	 */
	public function setName(string $name = null): Event
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @param Guest $guest
	 *
	 * @return Event
	 */
	public function addGuest(Guest $guest): Event
	{
		$this->guest[] = $guest;

		return $this;
	}

	/**
	 * @param Guest $guest
	 *
	 * @return Event
	 */
	public function removeGuest(Guest $guest): Event
	{
		$this->guest->removeElement($guest);

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getGuest(): ArrayCollection
	{
		return $this->guest;
	}

	/**
	 * @param Tag $tag
	 *
	 * @return Event
	 */
	public function addTag(Tag $tag): Event
	{
		$this->tag[] = $tag;

		return $this;
	}

	/**
	 * @param Tag $tag
	 *
	 * @return Event
	 */
	public function removeTag(Tag $tag): Event
	{
		$this->tag->removeElement($tag);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTag()
	{
		return $this->tag;
	}

	/**
	 * @return float
	 */
	public function getLongitude(): float
	{
		return $this->longitude;
	}

	/**
	 * @param float $longitude
	 *
	 * @return $this
	 */
	public function setLongitude(float $longitude): Event
	{
		$this->longitude = $longitude;

		return $this;
	}
}
