<?php

namespace EventManagementBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\ScopeInterface;
use EventManagementBundle\Representation\EventRepresentation;
use UserBundle\Entity\User;
use UserBundle\Representation\UserRepresentation;

/**
 * Class UserScope
 * @package EventManagementBundle\Transformer\Scope
 */
class UserScope implements ScopeInterface
{
	//TODO EM as abstract inherit
	/**
	 * @return string
	 */
	public function getScopeName(): string
	{
		return 'event.user';
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function extendedTransformer($input): RepresentationInterface
	{
		$userRepresentation = new UserRepresentation();
		$userRepresentation->setUsername("TMP");

		/** @var EventRepresentation $input */
		$input->setUser($userRepresentation);

		return $input;
	}

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return true;
	}
}