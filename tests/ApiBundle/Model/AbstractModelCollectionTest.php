<?php

namespace ApiBundle\Model;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractModelCollectionTest
 */
class AbstractModelCollectionTest extends TestCase
{
	/**
	 * @var AbstractModelCollection
	 */
	private $mock;

	public function setUp()
	{
		$this->mock = $this->getMockBuilder(AbstractModelCollection::class)
		                   ->setConstructorArgs([[]])
		                   ->getMockForAbstractClass();
	}

	public function testAccessors()
	{
		$this->assertEquals($this->mock->getCollection(), []);
		$this->mock->setCollection(['firstElement']);
		$this->assertCount(1, $this->mock->getCollection());
		$this->assertContains('firstElement', $this->mock->getCollection());
	}
}