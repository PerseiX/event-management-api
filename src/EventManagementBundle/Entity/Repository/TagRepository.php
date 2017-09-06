<?php

namespace EventManagementBundle\Entity\Repository;

use ApiBundle\Entity\Repository\ApiRepository;
use EventManagementBundle\Entity\Event;
use Doctrine\ORM\Query;

/**
 * Class TagRepository
 * @package EventManagementBundle\Entity\Repository
 */
class TagRepository extends ApiRepository
{
	/**
	 * @param Event $event
	 *
	 * @return Query
	 */
	public function tagsCollectionQuery(Event $event): Query
	{
		$query = $this->createQueryBuilder('tag_repository')
		              ->andWhere('tag_repository.event = :event')
		              ->setParameter('event', $event);
		$query = $this->customerSorting->apply($query)->getQuery();

		return $query;
	}

}