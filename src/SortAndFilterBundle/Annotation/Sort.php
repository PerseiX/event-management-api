<?php

namespace SortAndFilterBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Sort
 * @package SortAndFilterBundle\Annotation
 *
 * @Annotation
 * @Target("METHOD")
 */
class Sort extends Annotation
{
	/**
	 * @var string
	 */
	public $field;

	/**
	 * @var string
	 */
	public $orderBy;

	/**
	 * @var array
	 */
	public $availableField;

	/**
	 * @return string
	 */
	public function getField(): string
	{
		return $this->field;
	}

	/**
	 * @return mixed
	 */
	public function getOrderBy()
	{
		return $this->orderBy;
	}

	/**
	 * @return array
	 */
	public function getAvailableField(): array
	{
		return $this->availableField;
	}
}