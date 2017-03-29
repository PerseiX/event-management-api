<?php
declare(strict_types = 1);

namespace EventManagementBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\AbstractTransformerScope;
use EventManagementBundle\Representation\EventRepresentation;
use Negotiation\Exception\InvalidArgument;
use UserBundle\Representation\UserRepresentation;

/**
 * Class UserScope
 * @package EventManagementBundle\Transformer\Scope
 */
class UserScope extends AbstractTransformerScope
{
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
		if (!$input instanceof EventRepresentation) {
			throw new InvalidArgument("Invalid argument. This class is not allowed.");
		}

		$user = $this->getEm()->getRepository('UserBundle:User')->getUser($input);

		/** @var UserRepresentation $userRepresentation */
		$userRepresentation = $this->transformer->transform($user);

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
		return $this->getAllowedScopesRepository()->scopeIsSupported($this->getScopeName());
	}
}