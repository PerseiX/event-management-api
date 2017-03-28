<?php

namespace EventManagementBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;
use UserBundle\Representation\UserRepresentation;

/**
 * Class EventRepresentation
 * @package EventManagementBundle\Representation
 */
class EventRepresentation implements RepresentationInterface
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 */
	private $eventTerm;

	/**
	 * @var boolean
	 */
	private $active;

	/**
	 * @var integer
	 */
	private $userId;

	/**
	 * @var UserRepresentation
	 */
	private $user;

	/**
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->userId;
	}

	/**
	 * @param int $userId
	 *
	 * @return $this
	 */
	public function setUserId(int $userId)
	{
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return UserRepresentation
	 */
	public function getUser(): UserRepresentation
	{
		return $this->user;
	}

	/**
	 * @param UserRepresentation $user
	 *
	 * @return $this
	 */
	public function setUser(UserRepresentation $user)
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return $this
	 */
	public function setId(?int $id)
	{
		$this->id = $id;

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
	public function getCreatedAt(): ?\DateTime
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTime|null $createdAt
	 *
	 * @return $this
	 */
	public function setCreatedAt(?\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;

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
	 * @return bool
	 */
	public function getActive(): ?bool
	{
		return $this->active;
	}

	/**
	 * @param bool|null $active
	 *
	 * @return $this
	 */
	public function setActive(?bool $active)
	{
		$this->active = $active;

		return $this;
	}
}