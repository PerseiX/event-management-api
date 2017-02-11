<?php

namespace ApiBundle\Entity;

/**
 * Class Example
 * @package ApiBundle\Entity
 */
class Example
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