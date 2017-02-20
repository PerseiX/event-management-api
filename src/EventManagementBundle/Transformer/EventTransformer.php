<?php

namespace EventManagementBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\TransformerInterface;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Representation\EventRepresentation;

/**
 * Class EventTransformer
 * @package EventManagementBundle\Transformer
 */
class EventTransformer implements TransformerInterface
{

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Event;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new EventRepresentation();

		/** @var Event $input */
		$representation->setId($input->getId())
		               ->setName($input->getName())
		               ->setCreateAt($input->getCreatedAt())
		               ->setDescription($input->getDescription())
		               ->setEventTerm($input->getEventTerm())
		               ->setIsActive($input->getIsActive());

		return $representation;
	}
}