<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Representation\GuestRepresentation;
use SortAndFilterBundle\Services\CustomSorting;

/**
 * Class TagRepository
 * @package EventManagementBundle\Entity\Repository
 */
class TagRepository extends EntityRepository
{
	/**
	 * @var CustomSorting
	 */
	private $customerSorting;

	/**
	 * @param CustomSorting $customerSorting
	 *
	 * @return TagRepository
	 */
	public function setCustomerSorting(CustomSorting $customerSorting): TagRepository
	{
		$this->customerSorting = $customerSorting;

		return $this;
	}

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

	/**
	 * @param GuestRepresentation $guestRepresentation
	 *
	 * @return array
	 */
	public function getTagsToGuest(GuestRepresentation $guestRepresentation): array
	{
		return $this->createQueryBuilder('tag_repository')
		            ->andWhere('tag_repository.id IN (:tagsId)')
		            ->setParameter('tagsId', $guestRepresentation->getTagsId())
		            ->getQuery()
		            ->getResult();
	}
}