<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Entity\Tag;
use SortAndFilterBundle\Services\CustomSorting;

/**
 * Class GuestRepository
 * @package EventManagementBundle\Entity\Repository
 */
class GuestRepository extends EntityRepository
{
	/**
	 * @var CustomSorting
	 */
	private $customerSorting;

	/**
	 * @param CustomSorting $customerSorting
	 *
	 * @return GuestRepository
	 */
	public function setCustomerSorting(CustomSorting $customerSorting): GuestRepository
	{
		$this->customerSorting = $customerSorting;

		return $this;
	}

	/**
	 * @param Event $event
	 *
	 * @return Query
	 */
	public function guestsToEventCollectionQuery(Event $event): Query
	{
		$query = $this->createQueryBuilder('guest_repository')
		              ->andWhere('guest_repository.event = :event')
		              ->setParameter('event', $event);
		$query = $this->customerSorting->apply($query)->getQuery();

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
		$query = $this->createQueryBuilder('guest_repository')
		              ->leftJoin('guest_repository.tag', 'tag_repository')
		              ->andWhere('guest_repository.event = :event')
		              ->andWhere('tag_repository  = :tags')
		              ->setParameter('event', $event)
		              ->setParameter('tags', $tag->getId());
		$query = $this->customerSorting->apply($query)->getQuery();

		return $query;
	}
}