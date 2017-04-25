<?php

namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\ActiveTrait;
use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Guest
 * @package EventManagementBundle\Entity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EventManagementBundle\Entity\Repository\GuestRepository")
 */
class Guest
{
	use IDTrait;
	use ActiveTrait;
	use CreatedAtTrait;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $createdBy;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=64)
	 */
	protected $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=64)
	 */
	protected $surname;

	/**
	 * @var Tag
	 *
	 * @ORM\ManyToOne(targetEntity="EventManagementBundle\Entity\Tag", inversedBy="guest")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $tag;

	/**
	 * @var Event
	 *
	 * @ORM\ManyToOne(targetEntity="EventManagementBundle\Entity\Event", inversedBy="guest")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $event;

	/**
	 * Guest constructor.
	 */
	public function __construct()
	{
		$this->active    = true;
		$this->createdAt = new \DateTime();
	}

	/**
	 * @return User
	 */
	public function getCreatedBy(): User
	{
		return $this->createdBy;
	}

	/**
	 * @param User $createdBy
	 *
	 * @return Guest
	 */
	public function setCreatedBy(User $createdBy): Guest
	{
		$this->createdBy = $createdBy;

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
	 * @return Guest
	 */
	public function setName(string $name): Guest
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSurname(): ?string
	{
		return $this->surname;
	}

	/**
	 * @param string $surname
	 *
	 * @return Guest
	 */
	public function setSurname(string $surname): Guest
	{
		$this->surname = $surname;

		return $this;
	}

	/**
	 * @return Tag
	 */
	public function getTag(): ?Tag
	{
		return $this->tag;
	}

	/**
	 * @param Tag $tag
	 *
	 * @return Guest
	 */
	public function setTag(Tag $tag): Guest
	{
		$this->tag = $tag;

		return $this;
	}

	/**
	 * @return Event
	 */
	public function getEvent(): ?Event
	{
		return $this->event;
	}

	/**
	 * @param Event $event
	 *
	 * @return Guest
	 */
	public function setEvent(?Event $event): Guest
	{
		$this->event = $event;

		return $this;
	}
}