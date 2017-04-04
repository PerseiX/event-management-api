<?php

namespace ApiBundle\Documentation;

use ApiBundle\Annotation\Scope;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Nelmio\ApiDocBundle\Extractor\HandlerInterface;
use Symfony\Component\Routing\Route;

/**
 * Class ScopeDocumentation
 * @package ApiBundle\Documentation
 */
class ScopeAnnotationHandler implements HandlerInterface
{
	/**
	 * @param ApiDoc            $annotation
	 * @param array             $annotations
	 * @param Route             $route
	 * @param \ReflectionMethod $method
	 */
	public function handle(ApiDoc $annotation, array $annotations, Route $route, \ReflectionMethod $method)
	{
		foreach ($annotations as $annotationElement) {
			if ($annotationElement instanceof Scope) {
				$annotation->addParameter('with', [
					"dataType"    => "string",
					"required"    => false,
					"description" => $annotationElement->getScope()
				]);
			}
		}
	}
}