<?php
declare(strict_types = 1);

namespace SortAndFilterBundle\Annotation;

use Doctrine\Common\Annotations\Reader;
use SortAndFilterBundle\Model\AvailableSorting;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class SortAnnotationReader
 * @package SortAndFilterBundle\Annotation
 */
class SortAnnotationReader implements EventSubscriberInterface
{
	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * @var AvailableSorting
	 */
	private $availableSorting;

	/**
	 * SortAnnotationReader constructor.
	 *
	 * @param Reader           $reader
	 * @param AvailableSorting $availableSorting
	 */
	public function __construct(Reader $reader, AvailableSorting $availableSorting)
	{
		$this->reader               = $reader;
		$this->availableSorting = $availableSorting;
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
			if ($configuration instanceof Sort) {
				foreach ($configuration->getAvailableField() as $field) {
					$this->availableSorting->addField($field);
				}
				$this->availableSorting->setDefault($configuration->getDefault());
				$this->availableSorting->setAlias($configuration->getAlias());
			}
		}
	}
}