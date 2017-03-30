<?php

namespace ApiBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;

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

	/**
	 * @param RepresentationInterface $input
	 */
	public function handle(RepresentationInterface $input)
	{
		/** @var ScopeInterface $scope */
		foreach ($this->scopes as $scope) {
			if ($scope->support($input)) {
				$scope->extendedTransformer($input);
			}
		}
	}
}