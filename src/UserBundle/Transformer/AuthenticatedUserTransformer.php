<?php

namespace UserBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use UserBundle\Model\AuthenticatedUserModel;
use UserBundle\Representation\AuthenticatedUserRepresentation;

/**
 * Class AuthenticatedUserTransformer
 * @package UserBundle\Transformer
 */
class AuthenticatedUserTransformer implements TransformerInterface
{

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof AuthenticatedUserModel;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new AuthenticatedUserRepresentation();

		/** @var AuthenticatedUserModel $input */
		$representation->setRefreshToken($input->getRefreshToken()->getToken())
		               ->setRefreshTokenExpiresAt($input->getRefreshToken()->getExpiresAt())
		               ->setAccessToken($input->getAccessToken()->getToken())
		               ->setAccessTokenExpiresAt($input->getAccessToken()->getExpiresAt())
		               ->setClientSecret($input->getAccessToken()->getClient()->getSecret())
		               ->setClientIdentify($input->getAccessToken()->getClient()->getPublicId())
		               ->setUsername($input->getAccessToken()->getUser()->getUsername())
		               ->setEmail($input->getAccessToken()->getUser()->getUsername());

		return $representation;
	}
}