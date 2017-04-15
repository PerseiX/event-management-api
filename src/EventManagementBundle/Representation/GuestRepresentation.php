<?php

namespace EventManagementBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;
use EventManagementBundle\Entity\Tag;
use UserBundle\Entity\User;

/**
 * Class GuestRepresentation
 * @package EventManagementBundle\Representation
 */
class GuestRepresentation implements RepresentationInterface
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var boolean
	 */
	private $active;

	/**
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var integer
	 */
	private $createdById;

	/**
	 * @var User
	 */
	private $createdBy;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $surname;

	/**
	 * @var Tag
	 */
	private $tag;

	/**
	 * @var integer
	 */
	private $tagId;

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
	 * @return GuestRepresentation
	 */
	public function setId(int $id): GuestRepresentation
	{
		$this->id = $id;

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
	 * @return GuestRepresentation
	 */
	public function setActive(bool $active): GuestRepresentation
	{
		$this->active = $active;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTime $createdAt
	 *
	 * @return GuestRepresentation
	 */
	public function setCreatedAt(\DateTime $createdAt): GuestRepresentation
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getCreatedById(): int
	{
		return $this->createdById;
	}

	/**
	 * @param int $createdById
	 *
	 * @return GuestRepresentation
	 */
	public function setCreatedById(int $createdById): GuestRepresentation
	{
		$this->createdById = $createdById;

		return $this;
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
	 * @return GuestRepresentation
	 */
	public function setCreatedBy(User $createdBy): GuestRepresentation
	{
		$this->createdBy = $createdBy;

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
	 * @return GuestRepresentation
	 */
	public function setName(string $name): GuestRepresentation
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSurname(): string
	{
		return $this->surname;
	}

	/**
	 * @param string $surname
	 *
	 * @return GuestRepresentation
	 */
	public function setSurname(string $surname): GuestRepresentation
	{
		$this->surname = $surname;

		return $this;
	}

	/**
	 * @return Tag
	 */
	public function getTag(): Tag
	{
		return $this->tag;
	}

	/**
	 * @param Tag $tag
	 *
	 * @return GuestRepresentation
	 */
	public function setTag(Tag $tag): GuestRepresentation
	{
		$this->tag = $tag;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getTagId(): int
	{
		return $this->tagId;
	}

	/**
	 * @param int $tagId
	 *
	 * @return GuestRepresentation
	 */
	public function setTagId(int $tagId): GuestRepresentation
	{
		$this->tagId = $tagId;

		return $this;
	}
}