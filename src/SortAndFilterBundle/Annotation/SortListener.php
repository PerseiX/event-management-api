<?php

namespace SortAndFilterBundle\Annotation;

use Doctrine\Common\Collections\Criteria;
use SortAndFilterBundle\Model\AvailableFieldToSort;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class SortAnnotationListener
 * @package SortAndFilterBundle\Annotation
 */
class SortListener implements EventSubscriberInterface
{
	/**
	 * @var AvailableFieldToSort
	 */
	private $availableField;

	/**
	 * ScopeListener constructor.
	 *
	 * @param AvailableFieldToSort $availableField
	 */
	public function __construct(AvailableFieldToSort $availableField)
	{
		$this->availableField = $availableField;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			KernelEvents:: CONTROLLER =>
				[
					['applySortParameter', -1]
				]
		];
	}

	/**
	 * @param FilterControllerEvent $event
	 */
	public function applySortParameter(FilterControllerEvent $event)
	{
		if (!$field = $event->getRequest()->get('sort')) {
			return;
		}

		if (!in_array(key($field), $this->availableField->getFieldToSort())) {
			throw new \InvalidArgumentException(sprintf("This '%s' field to sort is not available.", key($field)));
		}
		$fieldValue = array_values($field)[0];
		if (!in_array($fieldValue, [Criteria::ASC, Criteria::DESC])) {
			throw new \InvalidArgumentException(sprintf("This '%s' ordering type is not exist", $fieldValue));
		}
	}
}