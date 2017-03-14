<?php

namespace UserBundle\Resolver;

use Negotiation\Exception\InvalidArgument;
use UserBundle\Model\AuthorizationCodeModel;

/**
 * Class CodeResolver
 * @package UserBundle\Resolver
 */
class CodeResolver
{
	/**
	 * @var AuthorizationCodeModel
	 */
	private $authorizationCodeModel;

	/**
	 * CodeResolver constructor.
	 *
	 * @param AuthorizationCodeModel $authorizationCodeModel
	 */
	public function __construct(AuthorizationCodeModel $authorizationCodeModel)
	{
		$this->authorizationCodeModel = $authorizationCodeModel;
	}

	/**
	 * @param string $code
	 *
	 * @return AuthorizationCodeModel
	 */
	public function resolve(?string $code): AuthorizationCodeModel
	{
		if (null == $code) {
			throw new InvalidArgument(sprintf("This argument %s is invalid!", $code));
		}
		$this->authorizationCodeModel->setCode($code);

		return $this->authorizationCodeModel;
	}
}