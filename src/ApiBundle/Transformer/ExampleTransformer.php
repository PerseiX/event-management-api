<?php

namespace ApiBundle\Transformer;

use ApiBundle\Entity\Example;
use ApiBundle\Representation\ExampleRepresentation;
use ApiBundle\Representation\RepresentationInterface;

/**
 * Class ExampleTransformer
 * @package ApiBundle\Transformer
 */
class ExampleTransformer implements TransformerInterface
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Example;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$example = new ExampleRepresentation();
		$example->setId($input->getId());

		return $example;
	}
}