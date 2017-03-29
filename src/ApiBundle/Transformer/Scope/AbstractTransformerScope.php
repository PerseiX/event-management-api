<?php
declare(strict_types = 1);

namespace ApiBundle\Transformer\Scope;

use ApiBundle\Transformer\Transformer;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AbstractTransformerScope
 * @package ApiBundle\Transformer\Scope
 */
abstract class AbstractTransformerScope implements ScopeInterface
{
	/**
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 * @var Transformer
	 */
	protected $transformer;

	/**
	 * @var AllowedScopesRepository
	 */
	protected $allowedScopes;

	/**
	 * AbstractTransformerScope constructor.
	 *
	 * @param ObjectManager           $em
	 * @param Transformer             $transformer
	 * @param AllowedScopesRepository $allowedScopesRepository
	 */
	public function __construct(ObjectManager $em, Transformer $transformer, AllowedScopesRepository $allowedScopesRepository)
	{
		$this->em            = $em;
		$this->transformer   = $transformer;
		$this->allowedScopes = $allowedScopesRepository;
	}

	/**
	 * @return ObjectManager
	 */
	public function getEm(): ObjectManager
	{
		return $this->em;
	}

	/**
	 * @return Transformer
	 */
	public function getTransformer(): Transformer
	{
		return $this->transformer;
	}

	/**
	 * @return AllowedScopesRepository
	 */
	public function getAllowedScopesRepository(): AllowedScopesRepository
	{
		return $this->allowedScopes;
	}
}