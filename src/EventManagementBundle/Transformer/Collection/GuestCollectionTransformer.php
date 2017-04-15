<?php

namespace EventManagementBundle\Transformer\Collection;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use EventManagementBundle\Model\GuestModel;
use EventManagementBundle\Representation\GuestCollectionRepresentation;

/**
 * Class GuestCollectionTransformer
 * @package EventManagementBundle\Transformer\Collection
 */
class GuestCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof GuestModel;
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

		return new GuestCollectionRepresentation($collection);
	}
}