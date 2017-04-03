<?php

namespace ApiBundle\Annotation;

use ApiBundle\Transformer\Scope\AllowedScopesRepository;
use ApiBundle\Transformer\Scope\ScopeInterface;
use ApiBundle\Transformer\Scope\ScopeRepository;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ScopeAnnotationReader
 * @package ApiBundle\Annotation
 */
class ScopeAnnotationReader implements EventSubscriberInterface
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
	 * @var ScopeRepository
	 */
	private $scopeRepository;

	/**
	 * ScopeAnnotationReader constructor.
	 *
	 * @param Reader                  $reader
	 * @param AllowedScopesRepository $allowedScopeRepository
	 * @param ScopeRepository         $scopeRepository
	 */
	public function __construct(Reader $reader, AllowedScopesRepository $allowedScopeRepository, ScopeRepository $scopeRepository)
	{
		$this->reader                 = $reader;
		$this->allowedScopeRepository = $allowedScopeRepository;
		$this->scopeRepository        = $scopeRepository;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::CONTROLLER =>
				[
					['onKernelController', 1]
				]
		];
	}

	/**
	 * @param FilterControllerEvent $event
	 */
	public function onKernelController(FilterControllerEvent $event)
	{
		if (!is_array($controller = $event->getController())) {
			return;
		}

		$object            = new \ReflectionObject($controller[0]);
		$method            = $object->getMethod($controller[1]);
		$methodAnnotations = $this->reader->getMethodAnnotations($method);

		foreach ($methodAnnotations as $configuration) {

			if (isset($configuration->scope)) {
				/** @var ScopeInterface $scope */
				foreach ($this->allowedScopeRepository->getAllowedScopes() as $scope) {
					if ($scope->getScopeName() === $configuration->scope) {
						$this->scopeRepository->addSupportedScopes($scope);
					}
				}
			}
		}
	}

}