<?php

namespace UserBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use UserBundle\Entity\User;
use UserBundle\Representation\UserRepresentation;

/**
 * Class UserTransformer
 * @package UserBundle\Transformer
 */
class UserTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof User;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new UserRepresentation();

		/** @var User $input */
		$representation->setId($input->getId())
		               ->setEmail($input->getEmail())
		               ->setRoles($input->getRoles())
		               ->setUsername($input->getUsername());

		return $representation;
	}
}