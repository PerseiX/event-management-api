<?php

namespace EventManagementBundle\Transformer\Collection;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use EventManagementBundle\Model\EventModel;
use EventManagementBundle\Representation\EventCollectionRepresentation;

/**
 * Class EventCollectionTransformer
 * @package EventManagementBundle\Transformer\Collection
 */
class EventCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof EventModel;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$collection = [];

		/** @var AbstractModelCollection $input */
		foreach ($input->getCollection() as $item) {
			$collection[] = $this->getTransformer()->transform($item);
		}

		return new EventCollectionRepresentation($collection);
	}
}