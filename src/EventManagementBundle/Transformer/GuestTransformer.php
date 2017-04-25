<?php

namespace EventManagementBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use EventManagementBundle\Entity\Guest;
use EventManagementBundle\Representation\GuestRepresentation;

/**
 * Class GuestTransformer
 * @package EventManagementBundle\Transformer
 */
class GuestTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Guest;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new GuestRepresentation();

		/** @var Guest $input */
		$representation->setName($input->getName())
		               ->setActive($input->getActive())
		               ->setId($input->getId())
		               ->setCreatedAt($input->getCreatedAt())
		               ->setCreatedById($input->getCreatedBy()->getId())
		               ->setSurname($input->getSurname())
		               ->setTagId($input->getTag()->getId())
		               ->setEventId($input->getEvent()->getId());

		return $representation;
	}
}