<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 06.02.17
 * Time: 20:02
 */

namespace ApiBundle\Transformer;

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
	public function addTransformer($transformer)
	{
		if (true === in_array($transformer, $this->transformers)) {
			throw new Exception('This transformer is already added to transformers collection');
		}
		$this->transformers[] = $transformer;
	}

	/**
	 * @param $input
	 *
	 * @return mixed
	 */
	public function transform($input)
	{
		$transformer = $this->getTransformer($input);

		return $transformer->transform($input);
	}

	/**
	 * @param $input
	 *
	 * @return mixed
	 */
	protected function getTransformer($input)
	{
		foreach ($this->transformers as $transformer) {
			if ($transformer->support($input)) {
				return $transformer;
			}
		}
		throw new NotFoundResourceException(sprintf('Looked for transformer %s doesn\'t found!"', $input));
	}
}