<?php

namespace ApiBundle\Model;

/**
 * Class AbstractModelCollection
 * @package ApiBundle\Model
 */
abstract class AbstractModelCollection
{
	/**
	 * @var array
	 */
	protected $collection;

	/**
	 * AbstractModelCollection constructor.
	 *
	 * @param $collection
	 */
	public function __construct(array $collection)
	{
		$this->collection = $collection;
	}

	/**
	 * @return array
	 */
	public function getCollection(): array
	{
		return $this->collection;
	}

	/**
	 * @param $collection
	 *
	 * @return $this
	 */
	public function setCollection($collection)
	{
		$this->collection = $collection;

		return $this;
	}

}