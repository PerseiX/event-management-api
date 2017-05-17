<?php

namespace EventManagementBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\AbstractTransformerScope;
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
	 * @return string
	 */
	public function getScopeName(): string
	{
		return 'guest.tag';
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function extendedTransformer($input): RepresentationInterface
	{
		if (!$input instanceof GuestRepresentation) {
			throw new InvalidArgument("Invalid argument. This class is not allowed.");
		}

		/** @var GuestRepresentation $input */
		$tags = $this->em->getRepository('EventManagementBundle:Tag')->getTagsToGuest($input);

		foreach ($tags as $tag) {
			/** @var TagRepresentation $tagRepresentation */
			$tagRepresentation = $this->getTransformer()->transform($tag);
			$input->addTag($tagRepresentation);
		}

		return $input;
	}

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof GuestRepresentation;
	}
}