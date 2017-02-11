<?php

namespace ApiBundle\Transformer;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Model\ExampleModel;
use ApiBundle\Representation\ExampleCollectionRepresentation;
use ApiBundle\Representation\RepresentationInterface;

/**
 * Class ExampleCollectionTransformer
 * @package ApiBundle\Transformer
 */
class ExampleCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof ExampleModel;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$transformer = null;
		$collection  = [];

		/** @var AbstractModelCollection $input */
		foreach ($input->getCollection() as $item) {
			if (null === $transformer) {
				$transformer = $this->getTransformer()->getTransformer($item);
			}
			$collection[] = $transformer->transform($item);
		}

		return new ExampleCollectionRepresentation($collection);
	}
}