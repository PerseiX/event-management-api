<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class EventRepository
 * @package EventManagementBundle\Entity\Repository
 */
class EventRepository extends EntityRepository
{
	/**
	 * @return Query
	 */
	public function eventsCollectionQuery(): Query
	{
		$query = $this->createQueryBuilder('event')
		              ->getQuery();

		return $query;
	}
}