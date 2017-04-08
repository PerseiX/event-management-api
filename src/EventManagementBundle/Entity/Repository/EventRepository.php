<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;

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

	/**
	 * @param Event $event
	 *
	 * @return Event
	 */
	public function getEventWithUser(Event $event): Event
	{
		return $this->createQueryBuilder('event')
		            ->leftJoin('event.user', 'user')
		            ->andWhere('event.id = :eventId')
		            ->setParameter('eventId', $event->getId())
		            ->getQuery()
		            ->getSingleResult();
	}
}