<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Representation\GuestRepresentation;

/**
 * Class TagRepository
 * @package EventManagementBundle\Entity\Repository
 */
class TagRepository extends EntityRepository
{
	/**
	 * @param Event $event
	 *
	 * @return Query
	 */
	public function tagsCollectionQuery(Event $event): Query
	{
		$query = $this->createQueryBuilder('tag')
		              ->andWhere('tag.event = :event')
		              ->setParameter('event', $event)
		              ->getQuery();

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