<?php
declare(strict_types = 1);
namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use ApiBundle\Entity\Traits\ActiveTrait;
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
	 * @ORM\OneToMany(targetEntity="EventManagementBundle\Entity\Guest", mappedBy="event")
	 */
	protected $guest;

	/**
	 * @ORM\OneToMany(targetEntity="EventManagementBundle\Entity\Tag", mappedBy="event")
	 */
	protected $tag;

	/**
	 * Event constructor.
	 */
	public function __construct()
	{
		$this->createdAt = new \DateTime();
		$this->active    = false;
	}

	/**
	 * @return string
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return $this
	 */
	public function setDescription(string $description = null)
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
	 * @param \DateTime $eventTerm
	 *
	 * @return $this
	 */
	public function setEventTerm(\DateTime $eventTerm = null)
	{
		$this->eventTerm = $eventTerm;

		return $this;
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
	 * @return $this
	 */
	public function setName(string $name = null)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @param Guest $guest
	 *
	 * @return $this
	 */
	public function addGuest(Guest $guest)
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
	 * @return Guest
	 */
	public function getGuest(): Guest
	{
		return $this->guest;
	}

	/**
	 * Add tag
	 *
	 * @param \EventManagementBundle\Entity\Tag $tag
	 *
	 * @return Event
	 */
	public function addTag(Tag $tag)
	{
		$this->tag[] = $tag;

		return $this;
	}

	/**
	 * @param Tag $tag
	 */
	public function removeTag(Tag $tag)
	{
		$this->tag->removeElement($tag);
	}

	/**
	 * @return mixed
	 */
	public function getTag()
	{
		return $this->tag;
	}
}
