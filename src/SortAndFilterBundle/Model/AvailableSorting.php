<?php
declare(strict_types = 1);

namespace SortAndFilterBundle\Model;

/**
 * Class AvailableSorting
 * @package SortAndFilterBundle\Model
 */
class AvailableSorting
{
	/**
	 * @var array
	 */
	private $fieldToSort;

	/**
	 * @var string
	 */
	private $default;

	/**
	 * @var string
	 */
	private $alias;

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
	 * @return AvailableSorting
	 */
	public function addField(string $field): AvailableSorting
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

	/**
	 * @return string
	 */
	public function getDefault(): string
	{
		return $this->default;
	}

	/**
	 * @param string $default
	 *
	 * @return AvailableSorting
	 */
	public function setDefault(string $default): AvailableSorting
	{
		$this->default = $default;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAlias(): string
	{
		return $this->alias;
	}

	/**
	 * @param string $alias
	 *
	 * @return AvailableSorting
	 */
	public function setAlias(string $alias): AvailableSorting
	{
		$this->alias = $alias;

		return $this;
	}
}