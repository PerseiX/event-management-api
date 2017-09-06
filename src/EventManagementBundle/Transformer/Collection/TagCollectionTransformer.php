<?php

namespace EventManagementBundle\Transformer\Collection;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use EventManagementBundle\Model\TagCollectionModel;
use EventManagementBundle\Representation\TagCollectionRepresentation;

/**
 * Class TagCollectionTransformer
 * @package EventManagementBundle\Transformer\Collection
 */
class TagCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof TagCollectionModel;
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

		return new TagCollectionRepresentation($collection);
	}
}