<?php

namespace UserBundle\Transformer;

use ApiBundle\Entity\AccessToken;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use UserBundle\Entity\User;
use UserBundle\Representation\AccessTokenRepresentation;

/**
 * Class AccessTokenTransformer
 * @package UserBundle\Transformer
 */
class AccessTokenTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof AccessToken;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new AccessTokenRepresentation();

		/**
		 * @var User        $user
		 * @var AccessToken $input
		 */
		$user = $input->getUser();
		$representation->setToken($input->getToken())
		               ->setExpiredAt($input->getExpiresAt())
		               ->setUserId($user->getId());

		return $representation;
	}
}