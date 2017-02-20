<?php

namespace EventManagementBundle\Controller;

use EventManagementBundle\Entity\Event;
use EventManagementBundle\Model\EventModel;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class EventController extends FOSRestController
{
	/**
	 * @return Response
	 */
	public function getEventsAction()
	{
		$events         = $this->getDoctrine()->getRepository('EventManagementBundle:Event')
		                       ->findAll();
		$representation = $this->get('api.main_transformer')->transform(new EventModel($events));

		$view = $this->view($representation, Response::HTTP_OK);

		return $this->handleView($view);
	}
}
