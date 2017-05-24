<?php
declare(strict_types = 1);

namespace SortAndFilterBundle\Annotation;

use Doctrine\Common\Collections\Criteria;
use SortAndFilterBundle\Model\AvailableSorting;
use SortAndFilterBundle\Model\SortDetail;
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
	 * @var AvailableSorting
	 */
	private $availableSorting;

	/**
	 * @var SortDetail
	 */
	private $sortDetail;

	/**
	 * SortListener constructor.
	 *
	 * @param AvailableSorting $availableSorting
	 * @param SortDetail       $sortDetail
	 */
	public function __construct(AvailableSorting $availableSorting, SortDetail $sortDetail)
	{
		$this->availableSorting = $availableSorting;
		$this->sortDetail       = $sortDetail;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents(): array
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
	 *
	 * @return SortDetail
	 */
	public function applySortParameter(FilterControllerEvent $event): SortDetail
	{
		if (!$field = $event->getRequest()->get('sortBy')) {
			return $this->sortDetail;
		}
		$orderBy   = key($field);
		$orderType = $field[$orderBy];
		if ($orderBy === 0) {
			$orderBy = $this->availableSorting->getDefault();
		}

		if (!in_array($orderBy, $this->availableSorting->getFieldToSort())) {
			throw new \InvalidArgumentException(
				sprintf("This '%s' field to sort is not available.", $orderBy)
			);
		}

		if (!in_array($orderType, [Criteria::ASC, Criteria::DESC])) {
			throw new \InvalidArgumentException(
				sprintf("This '%s' ordering type is not exist. Available are ASC and DESC", $orderType)
			);
		}

		$this->sortDetail->setTypeOrder($orderType);
		$this->sortDetail->setOrderBy($this->availableSorting->getAlias() . '.' . $orderBy);

		return $this->sortDetail;
	}
}