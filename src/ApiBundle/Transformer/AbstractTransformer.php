<?php
declare(strict_types = 1);

namespace ApiBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\ScopeRepository;

/**
 * Class AbstractTransformer
 * @package ApiBundle\Transformer
 */
abstract class AbstractTransformer implements TransformerInterface
{
	/**
	 * @var Transformer
	 */
	protected $transformer;

	/**
	 * @var ScopeRepository
	 */
	protected $scopeRepository;

	/**
	 * AbstractTransformer constructor.
	 *
	 * @param ScopeRepository $scopeRepository
	 */
	public function __construct(ScopeRepository $scopeRepository)
	{
		$this->scopeRepository = $scopeRepository;
	}

	/**
	 * @return Transformer
	 */
	public function getTransformer()
	{
		return $this->transformer;
	}

	/**
	 * @param Transformer $transformer
	 *
	 * @return $this
	 */
	public function setTransformer(Transformer $transformer)
	{
		$this->transformer = $transformer;

		return $this;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transformWithScope($input): RepresentationInterface
	{
		$representation = $this->transformer->transform($input);
		$this->scopeRepository->handle($representation);

		return $representation;
	}

}