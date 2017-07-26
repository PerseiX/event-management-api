<?php
declare(strict_types=1);

namespace SortAndFilterBundle\Model;

use Doctrine\Common\Collections\Criteria;

/**
 * Class SortDetail
 * @package SortAndFilterBundle\Model
 */
class SortDetail
{
	/**
	 * @var string
	 */
	private $typeOrder;

	/**
	 * @var string
	 *
	 * @Enum({"Criteria::ASC", "Criteria::DESC"})
	 */
	private $orderBy;

	/**
	 * @return mixed
	 */
	public function getOrderBy()
	{
		return $this->orderBy;
	}

	/**
	 * @param $orderBy
	 *
	 * @return null|SortDetail
	 */
	public function setOrderBy($orderBy): ?SortDetail
	{
		$this->orderBy = $orderBy;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getTypeOrder(): ?string
	{
		return $this->typeOrder;
	}

	/**
	 * @param string $typeOrder
	 *
	 * @return SortDetail
	 */
	public function setTypeOrder(string $typeOrder): SortDetail
	{
		$this->typeOrder = $typeOrder;

		return $this;
	}
}