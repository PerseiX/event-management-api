<?php

namespace EventManagementBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Doctrine\ORM\ORMException;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Form\Type\EventType;
use EventManagementBundle\Model\EventModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
		$form  = $this->createForm(EventType::class, $event);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Request $request
	 *
	 * @ParamConverter("event", options={"id" = "id"})
	 *
	 * @return Response
	 * @throws ORMException
	 */
	public function editEventAction(Request $request, Event $event)
	{
		$form = $this->createForm(EventType::class, $event, ['method' => $request->getMethod()]);

		return $this->formResponse($request, $form);
	}

	/**
	 * @ParamConverter("event", options={"id" = "id"})
	 *
	 * @return Response
	 * @throws ORMException
	 */
	public function deleteEventAction(Event $event)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($event);
		$em->flush();

		return $this->response(Response::HTTP_NO_CONTENT);
	}
}
