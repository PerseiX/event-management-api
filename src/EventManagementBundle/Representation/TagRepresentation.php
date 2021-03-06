<?php

namespace EventManagementBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class TagRepresentation
 * @package EventManagementBundle\Representation
 */
class TagRepresentation implements RepresentationInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var bool
	 */
	private $active;

	/**
	 * @var \DateTime
	 */
	private $createAt;

	/**
	 * @var int
	 */
	private $eventId;

	/**
	 * @var EventRepresentation
	 */
	private $event;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return TagRepresentation
	 */
	public function setId(int $id): TagRepresentation
	{
		$this->id = $id;

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
	 * @param string $name
	 *
	 * @return TagRepresentation
	 */
	public function setName(string $name): TagRepresentation
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 *
	 * @return TagRepresentation
	 */
	public function setActive(bool $active): TagRepresentation
	{
		$this->active = $active;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreateAt(): \DateTime
	{
		return $this->createAt;
	}

	/**
	 * @param \DateTime $createAt
	 *
	 * @return TagRepresentation
	 */
	public function setCreateAt(\DateTime $createAt): TagRepresentation
	{
		$this->createAt = $createAt;

		return $this;
	}

	/**
	 * @param int $eventId
	 *
	 * @return TagRepresentation
	 */
	public function setEventId(int $eventId): TagRepresentation
	{
		$this->eventId = $eventId;

		return $this;
	}

	/**
	 * @param EventRepresentation $event
	 *
	 * @return TagRepresentation
	 */
	public function setEvent(EventRepresentation $event): TagRepresentation
	{
		$this->event = $event;

		return $this;
	}

	/**
	 * @return EventRepresentation
	 */
	public function getEvent(): EventRepresentation
	{
		return $this->event;
	}

	/**
	 * @return int
	 */
	public function getEventId(): int
	{
		return $this->eventId;
	}
}