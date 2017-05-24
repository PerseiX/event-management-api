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
	private $availableFieldToSort;

	/**
	 * SortAnnotationReader constructor.
	 *
	 * @param Reader               $reader
	 * @param AvailableSorting $availableFieldToSort
	 */
	public function __construct(Reader $reader, AvailableSorting $availableFieldToSort)
	{
		$this->reader               = $reader;
		$this->availableFieldToSort = $availableFieldToSort;
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
					$this->availableFieldToSort->addField($field);
				}
				$this->availableFieldToSort->setDefault($configuration->getDefault());
			}
		}
	}
}