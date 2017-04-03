<?php
declare(strict_types = 1);

namespace ApiBundle\Transformer;

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
}