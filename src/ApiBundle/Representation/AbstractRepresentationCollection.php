<?php

namespace ApiBundle\Representation;

/**
 * Class AbstractRepresentationCollection
 * @package ApiBundle\Representation
 */
abstract class AbstractRepresentationCollection implements RepresentationInterface
{
	/**
	 * @var array
	 */
	protected $collection;

	/**
	 * AbstractRepresentationCollection constructor.
	 *
	 * @param array $collection
	 */
	public function __construct(array $collection)
	{
		$this->collection = $collection;
	}

	/**
	 * @return array
	 */
	public function getCollection() : array
	{
		return $this->collection;
	}

	/**
	 * @param $collection
	 *
	 * @return RepresentationInterface
	 */
	public function setCollection($collection): RepresentationInterface
	{
		$this->collection = $collection;

		return $this;
	}
}