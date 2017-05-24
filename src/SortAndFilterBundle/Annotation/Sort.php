<?php
declare(strict_types = 1);

namespace SortAndFilterBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Sort
 * @package SortAndFilterBundle\Annotation
 *
 * @Annotation
 * @Target("METHOD")
 */
final class Sort extends Annotation
{
	CONST DEFAULT_ORDER_BY = "createdAt";

	/**
	 * @var string
	 */
	public $default = self::DEFAULT_ORDER_BY;

	/**
	 * @var string
	 */
	public $alias;

	/**
	 * @var array
	 */
	public $availableField;

	/**
	 * @return string
	 */
	public function getDefault(): string
	{
		return $this->default;
	}

	/**
	 * @return array
	 */
	public function getAvailableField(): array
	{
		return $this->availableField;
	}

	/**
	 * @return string
	 */
	public function getAlias(): string
	{
		return $this->alias;
	}
}