<?php

namespace ApiBundle\Transformer\Scope;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class ScopeInterface
 * @package ApiBundle\Transformer\Scope
 */
interface ScopeInterface
{
	/**
	 * @return string
	 */
	public function getScopeName(): string;

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function extendedTransformer($input): RepresentationInterface;

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool;
}