<?php
declare(strict_types = 1);

namespace ApiBundle\Transformer\Scope;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class SupportedScopeRepresentation
 * @package ApiBundle\Transformer\Scope
 */
class AllowedScopesRepository extends ScopeRepository
{
	/**
	 * @var array
	 */
	private $allowedScopes = [];

	/**
	 * @param array $scopesName
	 *
	 * @return AllowedScopesRepository
	 */
	public function setAllowedScopes($scopesName = []): AllowedScopesRepository
	{
		foreach ($scopesName as $scopeName) {
			$this->addAllowedScope($scopeName);
		}

		return $this;
	}

	/**
	 * @param string $scopeName
	 *
	 * @return string
	 */
	private function addAllowedScope(string $scopeName): string
	{
		/** @var ScopeInterface $scope */
		foreach ($this->getScopes() as $scope) {
			if ($scope->getScopeName() == $scopeName) {
				return $this->allowedScopes[] = $scopeName;
			}
		}

		throw new Exception(sprintf('Scope name %s is not allowed. This scope does not exist.', $scopeName));
	}

	/**
	 * @return array
	 */
	public function getAllowedScopes(): array
	{
		return $this->allowedScopes;
	}

	/**
	 * @param $scopeName
	 *
	 * @return bool
	 */
	public function scopeIsSupported($scopeName): bool
	{
		return in_array($scopeName, $this->allowedScopes);
	}
}