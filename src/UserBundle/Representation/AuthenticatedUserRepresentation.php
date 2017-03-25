<?php

namespace UserBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class AuthenticatedUserRepresentation
 * @package UserBundle\Representation
 */
class AuthenticatedUserRepresentation implements RepresentationInterface
{
	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $accessToken;

	/**
	 * @var string
	 */
	private $refreshToken;

	/**
	 * @var string
	 */
	private $clientSecret;

	/**
	 * @var integer
	 */
	private $accessTokenExpiresAt;

	/**
	 * @var integer
	 */
	private $refreshTokenExpiresAt;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $clientIdentify;

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
	 * @return AuthenticatedUserRepresentation
	 */
	public function setUsername(string $username): AuthenticatedUserRepresentation
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

	/**
	 * @param string $accessToken
	 *
	 * @return AuthenticatedUserRepresentation
	 */
	public function setAccessToken(string $accessToken): AuthenticatedUserRepresentation
	{
		$this->accessToken = $accessToken;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRefreshToken(): string
	{
		return $this->refreshToken;
	}

	/**
	 * @param string $refreshToken
	 *
	 * @return AuthenticatedUserRepresentation
	 */
	public function setRefreshToken(string $refreshToken): AuthenticatedUserRepresentation
	{
		$this->refreshToken = $refreshToken;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getClientSecret(): string
	{
		return $this->clientSecret;
	}

	/**
	 * @param string $clientSecret
	 *
	 * @return AuthenticatedUserRepresentation
	 */
	public function setClientSecret(string $clientSecret): AuthenticatedUserRepresentation
	{
		$this->clientSecret = $clientSecret;

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
	 * @return AuthenticatedUserRepresentation
	 */
	public function setEmail(string $email): AuthenticatedUserRepresentation
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @param int $refreshTokenExpiresAt
	 *
	 * @return AuthenticatedUserRepresentation
	 */
	public function setRefreshTokenExpiresAt(int $refreshTokenExpiresAt): AuthenticatedUserRepresentation
	{
		$this->refreshTokenExpiresAt = $refreshTokenExpiresAt;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getRefreshTokenExpiresAt(): int
	{
		return $this->refreshTokenExpiresAt;
	}

	/**
	 * @return int
	 */
	public function getAccessTokenExpiresAt(): int
	{
		return $this->accessTokenExpiresAt;
	}

	/**
	 * @param int $accessTokenExpiresAt
	 *
	 * @return $this
	 */
	public function setAccessTokenExpiresAt(int $accessTokenExpiresAt)
	{
		$this->accessTokenExpiresAt = $accessTokenExpiresAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getClientIdentify(): string
	{
		return $this->clientIdentify;
	}

	/**
	 * @param string $clientIdentify
	 *
	 * @return $this
	 */
	public function setClientIdentify(string $clientIdentify)
	{
		$this->clientIdentify = $clientIdentify;

		return $this;
	}
}