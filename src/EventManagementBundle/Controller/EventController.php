<?php

namespace EventManagementBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use ApiBundle\Representation\RepresentationInterface;
use Doctrine\ORM\ORMException;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Form\Type\EventType;
use EventManagementBundle\Model\EventModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends AbstractApiController
{
	/**
	 * @return Response
	 */
	public function getEventsAction()
	{
		$events         = $this->getDoctrine()->getRepository('EventManagementBundle:Event')
		                       ->findAll();
		$representation = $this->get('api.main_transformer')->transform(new EventModel($events));

		return $this->representationResponse($representation);
	}

	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function createEventAction(Request $request)
	{
		$event = new Event();
		$form = $this->createForm(EventType::class, $event);

		return $this->formResponse($request, $form);
	}

}
