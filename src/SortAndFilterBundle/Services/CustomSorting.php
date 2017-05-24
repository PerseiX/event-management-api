<?php
declare(strict_types = 1);

namespace SortAndFilterBundle\Services;

use Doctrine\ORM\QueryBuilder;
use SortAndFilterBundle\Model\SortDetail;

/**
 * Class CustomSorting
 * @package SortAndFilterBundle\Services
 */
class CustomSorting
{
	/**
	 * @var SortDetail
	 */
	private $sortDetail;

	/**
	 * CustomSorting constructor.
	 *
	 * @param SortDetail $sortDetail
	 */
	public function __construct(SortDetail $sortDetail)
	{
		$this->sortDetail = $sortDetail;
	}

	/**
	 * @return bool
	 */
	public function support()
	{
		return $this->sortDetail->getTypeOrder() != "";
	}

	/**
	 * @param QueryBuilder $queryBuilder
	 *
	 * @return QueryBuilder
	 */
	public function apply(QueryBuilder $queryBuilder): QueryBuilder
	{
		if ($this->support()) {
			$queryBuilder->orderBy($this->sortDetail->getOrderBy(), $this->sortDetail->getTypeOrder());
		}

		return $queryBuilder;
	}
}