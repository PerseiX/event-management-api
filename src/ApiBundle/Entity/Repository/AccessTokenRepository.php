<?php

namespace ApiBundle\Entity\Repository;

use ApiBundle\Entity\AccessToken;
use Doctrine\ORM\EntityRepository;

/**
 * Class AccesTokenRepository
 * @package ApiBundle\Entity\Repository
 */
class AccessTokenRepository extends EntityRepository
{
	/**
	 * @param AccessToken $accessToken
	 */
	public function userDetailFromAccessToken(AccessToken $accessToken)
	{
	}
}