<?php

namespace ApiBundle\Transformer\Scope;

/**
 * Class ScopeHandler
 * @package ApiBundle\Transformer\Scope
 */
class ScopeRepository
{
	/**
	 * @var array
	 */
	private $scopes = [];

	/**
	 * @param ScopeInterface $scope
	 */
	public function addScope(ScopeInterface $scope)
	{
		if (!in_array($scope, $this->scopes)) {
			$this->scopes[] = $scope;
		}
	}

	/**
	 * @return array
	 */
	public function getScopes()
	{
		return $this->scopes;
	}

}