<?php

namespace ApiBundle\Transformer;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTransformerTest
 * @package ApiBundle\Transformer
 */
class AbstractTransformerTest extends TestCase
{
	/**
	 * @var AbstractTransformer
	 */
	private $mock;

	public function setUp()
	{
		$this->mock = $this->getMockForAbstractClass(AbstractTransformer::class);
	}

	public function testAccessor()
	{
		/** @var Transformer $transformer */
		$transformer = $this->createMock(Transformer::class);

		$this->assertEmpty($this->mock->getTransformer());
		$this->mock->setTransformer($transformer);
		$this->assertInstanceOf(Transformer::class, $this->mock->getTransformer());
	}

}