<?php

namespace ApiBundle\Annotation;

use ApiBundle\Transformer\Scope\AllowedScopesRepository;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class ScopeAnnotationReader
 * @package ApiBundle\Annotation
 */
class ScopeAnnotationReader
{
	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * @var AllowedScopesRepository
	 */
	private $allowedScopeRepository;

	/**
	 * ScopeAnnotationReader constructor.
	 *
	 * @param Reader                  $reader
	 * @param AllowedScopesRepository $allowedScopeRepository
	 */
	public function __construct(Reader $reader, AllowedScopesRepository $allowedScopeRepository)
	{
		$this->reader                 = $reader;
		$this->allowedScopeRepository = $allowedScopeRepository;
	}

	/**
	 * @param FilterControllerEvent $event
	 */
	public function onKernelController(FilterControllerEvent $event)
	{
		if (!is_array($controller = $event->getController())) {
			return;
		}

		$object        = new \ReflectionObject($controller[0]);
		$method        = $object->getMethod($controller[1]);
		$allowedScopes = [];

		$methodAnnotations = $this->reader->getMethodAnnotations($method);
		foreach ($methodAnnotations as $configuration) {
			if (isset($configuration->scope)) {
				$allowedScopes[] = $configuration->scope;
			}
		}
		$this->allowedScopeRepository->setAllowedScopes($allowedScopes);
	}

}