<?php
declare(strict_types=1);

namespace ApiBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use SortAndFilterBundle\Services\CustomSorting;

/**
 * Class ApiRepository
 * @package ApiBundle\Entity\Repository
 */
abstract class ApiRepository extends EntityRepository
{
	/**
	 * @var CustomSorting
	 */
	protected $customerSorting;

	/**
	 * @param CustomSorting $customerSorting
	 *
	 * @return $this
	 */
	public function setCustomerSorting(CustomSorting $customerSorting)
	{
		$this->customerSorting = $customerSorting;

		return $this;
	}
}