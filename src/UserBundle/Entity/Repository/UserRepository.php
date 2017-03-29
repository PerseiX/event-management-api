<?php

namespace UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use EventManagementBundle\Representation\EventRepresentation;
use UserBundle\Entity\User;

/**
 * Class UserRepository
 * @package UserBundle\Entity\Repository
 */
class UserRepository extends EntityRepository
{
	/**
	 * @param EventRepresentation $eventRepresentation
	 *
	 * @return User
	 */
	public function getUser(EventRepresentation $eventRepresentation): ?User
	{
		$result = $this->createQueryBuilder('user_repository')
		               ->where('user_repository.id = :user_id')
		               ->setParameter('user_id', $eventRepresentation->getUserId())
		               ->getQuery()
		               ->getOneOrNullResult();

		return $result;
	}
}