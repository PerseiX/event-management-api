<?php

namespace ApiBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\ScopeInterface;
use ApiBundle\Transformer\Scope\ScopeRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class Transformer
 * @package ApiBundle\Transformer
 */
class Transformer
{
	/** @var TransformerInterface */
	protected $transformers;

	/**
	 * @var ScopeRepository
	 */
	protected $scopeRepository;

	/**
	 * Transformer constructor.
	 *
	 * @param ScopeRepository $scopeRepository
	 */
	public function __construct(ScopeRepository $scopeRepository)
	{
		$this->scopeRepository = $scopeRepository;
		$this->transformers    = [];
	}

	/**
	 * @param TransformerInterface $transformer
	 *
	 * @return Transformer
	 */
	public function addTransformer(TransformerInterface $transformer): Transformer
	{
		if (true === in_array($transformer, $this->transformers)) {
			throw new Exception('This transformer is already added to transformers collection');
		}
		$this->transformers[] = $transformer;

		return $this;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		//TODO ScopeRepository exchange to Context
		$transformer    = $this->getTransformer($input);
		$representation = $transformer->transform($input);
		if ($representation instanceof RepresentationInterface) {
			$this->handle($representation, $input);
		}

		return $representation;
	}

	/**
	 * @param $input
	 *
	 * @return TransformerInterface
	 */
	public function getTransformer($input): TransformerInterface
	{
		foreach ($this->transformers as $transformer) {
			if ($transformer->support($input)) {
				return $transformer;
			}
		}
		throw new NotFoundResourceException(sprintf('Looked for transformer %s doesn\'t found!"', get_class($input)));
	}

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 */
	public function handle(RepresentationInterface $representation, $input)
	{
//		print_r(unserialize(serialize($this->scopeRepository->getScopes())));
		/** @var ScopeInterface $scope */
		foreach ($this->scopeRepository->getScopes() as $scopeName) {
			$scope = $this->scopeRepository->getSupportedScope($scopeName);
			if ($scope->support($representation, $input)) {
				$scope->applyScope($representation, $input);
			}
		}
	}
}