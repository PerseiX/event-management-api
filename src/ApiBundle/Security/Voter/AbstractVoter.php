<?php
declare(strict_types = 1);

namespace ApiBundle\Security\Voter;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class AbstractVoter
 * @package ApiBundle\Authorization\Voter
 */
abstract class AbstractVoter extends Voter
{
	CONST CREATE          = 'CREATE_PERMISSION';
	CONST EDIT            = 'CREATE_PERMISSION';
	CONST VIEW            = 'VIEW_PERMISSION';
	CONST VIEW_COLLECTION = 'VIEW_COLLECTION_PERMISSION';
	CONST DELETE          = 'DELETE_PERMISSION';
	CONST ENABLE          = 'ENABLE_PERMISSION';
	CONST DISABLE         = 'DISABLE_PERMISSION';

	/**
	 * @var AccessDecisionManagerInterface
	 */
	protected $decisionManager;

	/**
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 * AbstractVoter constructor.
	 *
	 * @param AccessDecisionManagerInterface $decisionManager
	 * @param ObjectManager                  $em
	 */
	public function __construct(AccessDecisionManagerInterface $decisionManager, ObjectManager $em)
	{
		$this->em              = $em;
		$this->decisionManager = $decisionManager;
	}

	/**
	 * @param $name
	 *
	 * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
	 */
	public function getReferredObject($name)
	{
		/** @var EntityManager $entityManager */
		$entityManager = $this->em;

		return $entityManager->getReference($name, 1);
	}
}