<?php

namespace UserBundle\Transformer;

use ApiBundle\Entity\RefreshToken;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use UserBundle\Entity\User;
use UserBundle\Representation\RefreshTokenRepresentation;

/**
 * Class RefreshTokenTransformer
 * @package UserBundle\Transformer
 */
class RefreshTokenTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof RefreshToken;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new RefreshTokenRepresentation();

		/**
		 * @var User         $user
		 * @var RefreshToken $input
		 */
		$user = $input->getUser();
		$representation->setExpiresAt($input->getExpiresAt())
		               ->setToken($input->getToken())
		               ->setUserId($user->getId());

		return $representation;
	}
}