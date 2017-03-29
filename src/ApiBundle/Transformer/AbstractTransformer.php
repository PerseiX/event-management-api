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
	 * AbstractTransformer constructor.
	 *
	 * @param Transformer $transformer
	 */
	public function __construct(Transformer $transformer)
	{
		$this->transformer = $transformer;
	}

	/**
	 * @return Transformer
	 */
	public function getTransformer()
	{
		return $this->transformer;
	}

	/**
	 * @param $transformer
	 *
	 * @return $this
	 */
	public function setTransformer($transformer)
	{
		$this->transformer = $transformer;

		return $this;
	}
}