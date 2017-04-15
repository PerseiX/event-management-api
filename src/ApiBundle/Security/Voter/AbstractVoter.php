<?php
declare(strict_types = 1);

namespace ApiBundle\Security\Voter;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Proxy\Proxy;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class AbstractVoter
 * @package ApiBundle\Security\Voter
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
	 * @param string $attribute
	 * @param mixed  $subject
	 *
	 * @return bool
	 */
	protected function supports($attribute, $subject): bool
	{
		if (!in_array(get_class($subject), $this->getSupportedClass())) {
			return false;
		}

		return in_array($attribute, $this->getSupportedPermissions());
	}

	/**
	 * @param $name
	 *
	 * @return bool|Proxy|null|object
	 */
	public function getReferredObject($name): ?Proxy
	{
		/** @var EntityManager $entityManager */
		$entityManager = $this->em;

		return $entityManager->getReference($name, 1);
	}

	/**
	 * @return array
	 */
	abstract protected function getSupportedClass(): array;

	/**
	 * @return array
	 */
	abstract protected function getSupportedPermissions(): array;
}