<?php

namespace ApiBundle\Representation;

/**
 * Class ExampleRepresentation
 * @package ApiBundle\Representation
 */
class ExampleRepresentation implements RepresentationInterface
{
	private $id;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

}