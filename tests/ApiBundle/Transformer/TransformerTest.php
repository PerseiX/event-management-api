<?php

namespace ApiBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\Scope\ScopeRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class TransformerTest
 */
class TransformerTest extends TestCase
{
	/**
	 * @var Transformer
	 */
	private $transformer;

	/**
	 * @var TransformerInterface
	 */
	private $mockTransformer;

	public function setUp()
	{

		$scope                 = new ScopeRepository();
		$this->mockTransformer = $this->createMock(TransformerInterface::class);
		$this->transformer     = new Transformer($scope);
	}

	public function testTransformer()
	{
		$this->mockTransformer
			->expects($this->exactly(1))
			->method('support')
			->will($this->returnValue(true));

		$representation = $this->createMock(RepresentationInterface::class);

		$this->mockTransformer
			->expects($this->exactly(1))
			->method('transform')
			->will($this->returnValue($representation));

		$this->transformer->addTransformer($this->mockTransformer);
		$representation = $this->transformer->transform(null);
		$this->assertInstanceOf(RepresentationInterface::class, $representation);
	}

	public function testRepresentationResponse()
	{
		$this->transformer->addTransformer($this->mockTransformer);
		$this->mockTransformer
			->expects($this->exactly(1))
			->method('support')
			->will($this->returnValue(true));

		$specialTransformer = $this->transformer->getTransformer($this->mockTransformer);
		$representation     = $specialTransformer->transform($this->mockTransformer);
		$this->assertInstanceOf(RepresentationInterface::class, $representation);
	}

	public function testEmptyTransformers()
	{
		$this->expectException(NotFoundResourceException::class);
		$this->transformer->getTransformer(null);
	}

	public function testDoubleTransformers()
	{
		$this->expectException(\LogicException::class);

		$this->transformer->addTransformer($this->mockTransformer);
		$this->transformer->addTransformer($this->mockTransformer);
	}
}