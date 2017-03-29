<?php

namespace ApiBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Scope
 * @package ApiBundle\Annotation
 *
 * @Annotation
 * @Target("METHOD")
 */
class Scope extends Annotation
{
	/**
	 * @var string
	 */
	public $scope;

	/**
	 * @return string
	 */
	public function getScope()
	{
		return $this->scope;
	}
}