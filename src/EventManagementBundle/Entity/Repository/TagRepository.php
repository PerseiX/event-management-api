<?php

namespace EventManagementBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

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
}