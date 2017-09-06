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
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return RepresentationInterface
	 */
	public function applyScope(RepresentationInterface $representation, $input): RepresentationInterface;

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return bool
	 */
	public function support(RepresentationInterface $representation, $input): bool;
}