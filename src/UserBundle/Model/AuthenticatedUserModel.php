<?php

namespace UserBundle\Model;

use ApiBundle\Entity\AccessToken;
use ApiBundle\Entity\RefreshToken;

/**
 * Class AuthenticatedUserModel
 * @package UserBundle\Model
 */
class AuthenticatedUserModel
{

	/**
	 * @var AccessToken
	 */
	private $accessToken;

	/**
	 * @var RefreshToken
	 */
	private $refreshToken;

	/**
	 * AuthenticatedUserModel constructor.
	 *
	 * @param AccessToken  $accessToken
	 * @param RefreshToken $refreshToken
	 */
	public function __construct(AccessToken $accessToken, RefreshToken $refreshToken)
	{
		$this->accessToken  = $accessToken;
		$this->refreshToken = $refreshToken;
	}

	/**
	 * @return AccessToken
	 */
	public function getAccessToken(): AccessToken
	{
		return $this->accessToken;
	}

	/**
	 * @param AccessToken $accessToken
	 *
	 * @return AuthenticatedUserModel
	 */
	public function setAccessToken(AccessToken $accessToken): AuthenticatedUserModel
	{
		$this->accessToken = $accessToken;

		return $this;
	}

	/**
	 * @return RefreshToken
	 */
	public function getRefreshToken(): RefreshToken
	{
		return $this->refreshToken;
	}

	/**
	 * @param RefreshToken $refreshToken
	 *
	 * @return AuthenticatedUserModel
	 */
	public function setRefreshToken(RefreshToken $refreshToken): AuthenticatedUserModel
	{
		$this->refreshToken = $refreshToken;

		return $this;
	}
}