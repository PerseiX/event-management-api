<?php

namespace EventManagementBundle\Entity;

use ApiBundle\Entity\Traits\CreatedAtTrait;
use ApiBundle\Entity\Traits\IDTrait;
use ApiBundle\Entity\Traits\ActiveTrait;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\Traits\UserTrait;
use UserBundle\Entity\User;

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
	public function setDescription(?string $description)
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
	public function setEventTerm(?\DateTime $eventTerm)
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
	public function setName(?string $name)
	{
		$this->name = $name;

		return $this;
	}
}