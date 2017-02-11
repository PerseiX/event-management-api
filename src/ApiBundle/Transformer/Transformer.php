<?php
namespace ApiBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
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
	 * Transformer constructor.
	 */
	public function __construct()
	{
		$this->transformers = [];
	}

	/**
	 * @param TransformerInterface $transformer
	 */
	public function addTransformer(TransformerInterface $transformer): void
	{
		if (true === in_array($transformer, $this->transformers)) {
			throw new Exception('This transformer is already added to transformers collection');
		}
		$this->transformers[] = $transformer;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$transformer = $this->getTransformer($input);

		return $transformer->transform($input);
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
}