<?php

namespace EventManagementBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Representation\TagRepresentation;

/**
 * Class TagTransformer
 * @package EventManagementBundle\Transformer
 */
class TagTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Tag;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new TagRepresentation();

		/** @var Tag $input */
		$representation->setId($input->getId())
		               ->setActive($input->getActive())
		               ->setCreateAt($input->getCreatedAt())
		               ->setName($input->getName())
		               ->setEventId($input->getEvent()->getId());

		return $representation;
	}
}