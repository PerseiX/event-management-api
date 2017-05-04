<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Entity\Tag;

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

	/**
	 * @param Event $event
	 * @param Tag   $tag
	 *
	 * @return Query
	 */
	public function guestsToEventAndTagCollectionQuery(Event $event, Tag $tag): Query
	{
		$query = $this->createQueryBuilder('guest')
		              ->andWhere('guest.event = :event')
		              ->andWhere('guest.tag = :tag')
		              ->setParameter('event', $event)
		              ->setParameter('tag', $tag)
		              ->getQuery();

		return $query;
	}
}