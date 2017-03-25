<?php

namespace UserBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class AccessTokenRepresentation
 * @package UserBundle\Representation
 */
class AccessTokenRepresentation implements RepresentationInterface
{
	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var integer
	 */
	private $userId;

	/**
	 * @var UserRepresentation
	 */
	private $user;

	/**
	 * @var integer
	 */
	private $expiredAt;

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
	 * @return AccessTokenRepresentation
	 */
	public function setUserId(int $userId): AccessTokenRepresentation
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
	 * @return AccessTokenRepresentation
	 */
	public function setUser(UserRepresentation $user): AccessTokenRepresentation
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getExpiredAt(): int
	{
		return $this->expiredAt;
	}

	/**
	 * @param int $expiredAt
	 *
	 * @return AccessTokenRepresentation
	 */
	public function setExpiredAt(int $expiredAt): AccessTokenRepresentation
	{
		$this->expiredAt = $expiredAt;

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