<?php
declare(strict_types=1);

namespace SortAndFilterBundle\Model\Repository;

use SortAndFilterBundle\Services\CustomSorting;
use Doctrine\ORM\EntityRepository;

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