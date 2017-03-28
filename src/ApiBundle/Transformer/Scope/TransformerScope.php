<?php

namespace ApiBundle\Transformer\Scope;

/**
 * Class ScopeHandler
 * @package ApiBundle\Transformer\Scope
 */
class TransformerScope
{
	/**
	 * @var ScopeRepository
	 */
	private $scopeRepository;

	/**
	 * ScopeHandler constructor.
	 *
	 * @param ScopeRepository $scopeRepository
	 */
	public function __construct(ScopeRepository $scopeRepository)
	{
		$this->scopeRepository = $scopeRepository;
	}

	/**
	 * @param $input
	 */
	public function handle($input)
	{
		/** @var ScopeInterface $scope */
		foreach ($this->scopeRepository->getScopes() as $scope) {
			if ($scope->support($input)) {
				$scope->extendedTransformer($input);
			}
		}
	}
}