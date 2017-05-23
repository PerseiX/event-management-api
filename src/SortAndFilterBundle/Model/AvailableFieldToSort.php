<?php

namespace SortAndFilterBundle\Model;

/**
 * Class AvailableFieldToSort
 * @package SortAndFilterBundle\Model
 */
class AvailableFieldToSort
{
	/**
	 * @var array
	 */
	private $fieldToSort;

	/**
	 * AvailableFieldToSort constructor.
	 */
	public function __construct()
	{
		$this->fieldToSort = [];
	}

	/**
	 * @param string $field
	 *
	 * @return AvailableFieldToSort
	 */
	public function addField(string $field): AvailableFieldToSort
	{
		if (in_array($field, $this->fieldToSort)) {
			throw new \InvalidArgumentException(sprintf("This field %s already added", $field));
		}
		$this->fieldToSort[] = $field;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getFieldToSort(): array
	{
		return $this->fieldToSort;
	}
}