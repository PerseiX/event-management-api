<?php

namespace SortAndFilterBundle\Documentation;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Nelmio\ApiDocBundle\Extractor\HandlerInterface;
use SortAndFilterBundle\Annotation\Sort;
use Symfony\Component\Routing\Route;

/**
 * Class SortAnnotationHandler
 * @package SortAndFilterBundle
 */
class SortAnnotationHandler implements HandlerInterface
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
			if ($annotationElement instanceof Sort) {
				$annotation->addParameter('sortBy[]', [
					"dataType"    => "array",
					"required"    => false,
					"description" => "Sort element"
				]);
			}
		}
	}
}