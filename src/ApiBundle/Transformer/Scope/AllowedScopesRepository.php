<?php
declare(strict_types = 1);

namespace ApiBundle\Transformer\Scope;

/**
 * Class SupportedScopeRepresentation
 * @package ApiBundle\Transformer\Scope
 */
class AllowedScopesRepository
{
	/**
	 * @var array
	 */
	private $allowedScopes = [];

	/**
	 * @param ScopeInterface $scope
	 *
	 * @return AllowedScopesRepository
	 */
	public function addScope(ScopeInterface $scope): AllowedScopesRepository
	{
		$this->allowedScopes[] = $scope;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getAllowedScopes(): array
	{
		return $this->allowedScopes;
	}

}