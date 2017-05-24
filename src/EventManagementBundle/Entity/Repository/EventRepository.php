<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;
use SortAndFilterBundle\Services\CustomSorting;

/**
 * Class EventRepository
 * @package EventManagementBundle\Entity\Repository
 */
class EventRepository extends EntityRepository
{
	/**
	 * @var CustomSorting
	 */
	private $customerSorting;

	/**
	 * @param CustomSorting $customerSorting
	 *
	 * @return EventRepository
	 */
	public function setCustomerSorting(CustomSorting $customerSorting): EventRepository
	{
		$this->customerSorting = $customerSorting;

		return $this;
	}

	/**
	 * @return Query
	 */
	public function eventsCollectionQuery(): Query
	{
		$query = $this->createQueryBuilder('event_repository');
		$query = $this->customerSorting->apply($query)->getQuery();

		return $query;
	}

	/**
	 * @param Event $event
	 *
	 * @return Event
	 */
	public function getEventWithUser(Event $event): Event
	{
		return $this->createQueryBuilder('event_repository')
		            ->leftJoin('event_repository.user', 'user')
		            ->andWhere('event_repository.id = :eventId')
		            ->setParameter('eventId', $event->getId())
		            ->getQuery()
		            ->getSingleResult();
	}
}