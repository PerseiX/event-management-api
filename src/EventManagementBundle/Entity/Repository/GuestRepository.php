<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;

/**
 * Class GuestRepository
 * @package EventManagementBundle\Entity\Repository
 */
class GuestRepository extends EntityRepository
{
	/**
	 * @param Event $event
	 *
	 * @return Query
	 */
	public function guestsToEventCollectionQuery(Event $event): Query
	{
		$query = $this->createQueryBuilder('guest')
		              ->andWhere('guest.event = :event')
		              ->setParameter('event', $event)
		              ->getQuery();

		return $query;
	}
}