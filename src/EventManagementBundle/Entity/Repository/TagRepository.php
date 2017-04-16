<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Representation\GuestRepresentation;

/**
 * Class TagRepository
 * @package EventManagementBundle\Entity\Repository
 */
class TagRepository extends EntityRepository
{
	/**
	 * @return Query
	 */
	public function tagsCollectionQuery(): Query
	{
		$query = $this->createQueryBuilder('tag')
		              ->getQuery();

		return $query;
	}

	/**
	 * @param GuestRepresentation $guestRepresentation
	 *
	 * @return Tag|null
	 */
	public function getTagToGuest(GuestRepresentation $guestRepresentation): ?Tag
	{
		return $this->createQueryBuilder('tag_repository')
		            ->andWhere('tag_repository.id = :tagId')
		            ->setParameter('tagId', $guestRepresentation->getTagId())
		            ->getQuery()
		            ->getOneOrNullResult();
	}
}