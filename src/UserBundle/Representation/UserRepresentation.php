<?php

namespace UserBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class UserRepresentation
 * @package UserBundle\Representation
 */
class UserRepresentation implements RepresentationInterface
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var array
	 */
	private $roles;

	/**
	 * @var string
	 */
	private $email;

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
	 * @return UserRepresentation
	 */
	public function setId(int $id): UserRepresentation
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 *
	 * @return UserRepresentation
	 */
	public function setUsername(string $username): UserRepresentation
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getRoles(): array
	{
		return $this->roles;
	}

	/**
	 * @param array $roles
	 *
	 * @return UserRepresentation
	 */
	public function setRoles(array $roles): UserRepresentation
	{
		$this->roles = $roles;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return UserRepresentation
	 */
	public function setEmail(string $email): UserRepresentation
	{
		$this->email = $email;

		return $this;
	}

}