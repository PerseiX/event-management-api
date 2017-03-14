<?php

namespace UserBundle\Model;

/**
 * Class AuthorizationCodeModel
 * @package ApiBundle\Model
 */
class AuthorizationCodeModel
{
	/**
	 * @var string
	 */
	private $grantType;

	/**
	 * @var string
	 */
	private $clientId;

	/**
	 * @var string
	 */
	private $clientSecret;

	/**
	 * @var string
	 */
	private $code;

	/**
	 * @var array
	 */
	private $redirectUri;

	/**
	 * @return string
	 */
	public function getGrantType(): string
	{
		return $this->grantType;
	}

	/**
	 * @param string $grantType
	 *
	 * @return $this
	 */
	public function setGrantType(string $grantType)
	{
		$this->grantType = $grantType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getClientId(): string
	{
		return $this->clientId;
	}

	/**
	 * @param string $clientId
	 *
	 * @return $this
	 */
	public function setClientId(string $clientId)
	{
		$this->clientId = $clientId;

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
	 * @return $this
	 */
	public function setClientSecret(string $clientSecret)
	{
		$this->clientSecret = $clientSecret;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 *
	 * @return $this
	 */
	public function setCode(string $code)
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getRedirectUri(): array
	{
		return $this->redirectUri;
	}

	/**
	 * @param array $redirectUri
	 *
	 * @return $this
	 */
	public function setRedirectUri(array $redirectUri)
	{
		$this->redirectUri = $redirectUri;

		return $this;
	}
}