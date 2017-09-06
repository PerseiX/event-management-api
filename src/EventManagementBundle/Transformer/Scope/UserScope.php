<?php
declare(strict_types=1);

namespace EventManagementBundle\Transformer\Scope;

use EventManagementBundle\Representation\EventRepresentation;
use ApiBundle\Transformer\Scope\AbstractTransformerScope;
use ApiBundle\Representation\RepresentationInterface;
use UserBundle\Representation\UserRepresentation;
use Negotiation\Exception\InvalidArgument;
use EventManagementBundle\Entity\Event;

/**
 * Class UserScope
 * @package EventManagementBundle\Transformer\Scope
 */
class UserScope extends AbstractTransformerScope
{

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return bool
	 */
	public function support(RepresentationInterface $representation, $input): bool
	{
		return $representation instanceof EventRepresentation && $input instanceof Event;
	}

	/**
	 * @return string
	 */
	public function getScopeName(): string
	{
		return 'event.user';
	}

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return RepresentationInterface
	 */
	public function applyScope(RepresentationInterface $representation, $input): RepresentationInterface
	{
		if (false === $input instanceof Event) {
			throw new InvalidArgument("Invalid argument. This class is not allowed.");
		}

		/** @var UserRepresentation $userRepresentation */
		$userRepresentation = $this->getTransformer()->transform($input->getUser());

		/** @var EventRepresentation $input */
		$input->setUser($userRepresentation);

		return $input;
	}

}