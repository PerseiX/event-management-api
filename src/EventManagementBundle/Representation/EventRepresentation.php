<?php

namespace EventManagementBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

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
	private $createAt;

	/**
	 * @var \DateTime
	 */
	private $eventTerm;

	/**
	 * @var boolean
	 */
	private $isActive;

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
	public function getCreateAt(): ?\DateTime
	{
		return $this->createAt;
	}

	/**
	 * @param \DateTime $createAt
	 *
	 * @return $this
	 */
	public function setCreateAt(?\DateTime $createAt)
	{
		$this->createAt = $createAt;

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
	public function getIsActive(): ?bool
	{
		return $this->isActive;
	}

	/**
	 * @param bool $isActive
	 *
	 * @return $this
	 */
	public function setIsActive(?bool $isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}
}