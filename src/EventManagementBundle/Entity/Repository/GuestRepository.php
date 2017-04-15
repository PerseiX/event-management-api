<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class GuestRepository
 * @package EventManagementBundle\Entity\Repository
 */
class GuestRepository extends EntityRepository
{
	/**
	 * @return Query
	 */
	public function guestsCollectionQuery(): Query
	{
		$query = $this->createQueryBuilder('guest')
		              ->getQuery();

		return $query;
	}
}