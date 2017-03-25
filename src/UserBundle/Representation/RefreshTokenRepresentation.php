<?php

namespace UserBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class RefreshTokenRepresentation
 * @package UserBundle\Representation
 */
class RefreshTokenRepresentation implements RepresentationInterface
{
	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var integer
	 */
	private $expiresAt;

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
	public function getExpiresAt(): int
	{
		return $this->expiresAt;
	}

	/**
	 * @param int $expiresAt
	 *
	 * @return RefreshTokenRepresentation
	 */
	public function setExpiresAt(int $expiresAt): RefreshTokenRepresentation
	{
		$this->expiresAt = $expiresAt;

		return $this;
	}

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
	 * @return RefreshTokenRepresentation
	 */
	public function setUserId(int $userId): RefreshTokenRepresentation
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
	 * @return RefreshTokenRepresentation
	 */
	public function setUser(UserRepresentation $user): RefreshTokenRepresentation
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getToken(): string
	{
		return $this->token;
	}

	/**
	 * @param string $token
	 *
	 * @return $this
	 */
	public function setToken(string $token)
	{
		$this->token = $token;

		return $this;
	}
}