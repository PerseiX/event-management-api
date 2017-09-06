<?php

namespace EventManagementBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\AbstractTransformerScope;
use EventManagementBundle\Entity\Guest;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Representation\EventRepresentation;
use EventManagementBundle\Representation\GuestRepresentation;
use EventManagementBundle\Representation\TagRepresentation;
use Negotiation\Exception\InvalidArgument;

/**
 * Class GuestTagScope
 * @package EventManagementBundle\Transformer\Scope
 */
class GuestTagScope extends AbstractTransformerScope
{

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return bool
	 */
	public function support(RepresentationInterface $representation, $input): bool
	{
		return $representation instanceof GuestRepresentation && $input instanceof Guest;
	}

	/**
	 * @return string
	 */
	public function getScopeName(): string
	{
		return 'guest.tag';
	}

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return RepresentationInterface
	 */
	public function applyScope(RepresentationInterface $representation, $input): RepresentationInterface
	{
		if (false === $input instanceof Guest) {
			throw new InvalidArgument("Invalid argument. This class is not allowed.");
		}

		/** @var Guest $input */
		foreach ($input->getTag()->getValues() as $tag) {
			/** @var TagRepresentation $tagRepresentation */
			$tagRepresentation = $this->getTransformer()->transform($tag);
			/** @var GuestRepresentation $representation */
			$representation->addTag($tagRepresentation);
		}

		return $representation;
	}
}