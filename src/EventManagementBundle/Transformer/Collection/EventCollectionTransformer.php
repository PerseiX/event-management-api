<?php

namespace EventManagementBundle\Transformer\Collection;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use ApiBundle\Transformer\TransformerInterface;
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
		$collection  = [];
		$transformer = null;

		/** @var AbstractModelCollection $input */
		foreach ($input->getCollection() as $item) {
			$collection[] = $this->transformWithScope($item);
		}

		return new EventCollectionRepresentation($collection);
	}
}