<?php

namespace EventManagementBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Doctrine\ORM\ORMException;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Form\Type\CreateEventType;
use EventManagementBundle\Form\Type\EditEventType;
use EventManagementBundle\Model\EventModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EventController extends AbstractApiController
{
	/**
	 * @return Response
	 */
	public function collectionAction()
	{
		$events         = $this->getDoctrine()->getRepository('EventManagementBundle:Event')
		                       ->findAll();
		$representation = $this->get('api.main_transformer')->transform(new EventModel($events));

		return $this->representationResponse($representation);
	}

	/**
	 * @param Event $event
	 *
	 * @ParamConverter("event", options={
	 *      "mapping": {
	 *            "eventId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 */
	public function singleAction(Event $event)
	{
		return $this->representationResponse($this->get('api.main_transformer')->transform($event));
	}

	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function createAction(Request $request)
	{
		$event = new Event();
		$form  = $this->createForm(CreateEventType::class, $event);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Request $request
	 * @param Event   $event
	 *
	 * @ParamConverter("event", options={
	 *     "mapping": {
	 *        "eventId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 * @throws ORMException
	 */
	public function editAction(Request $request, Event $event)
	{
		$form = $this->createForm(EditEventType::class, $event, ['method' => $request->getMethod()]);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Event $event
	 *
	 * @ParamConverter("event", options={
	 *     "mapping": {
	 *        "eventId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function deleteAction(Event $event)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($event);
		$em->flush();

		return $this->response(Response::HTTP_NO_CONTENT);
	}

	/**
	 * @param Event $event
	 *
	 * @ParamConverter("event", options={
	 *     "mapping": {
	 *        "eventId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function enableAction(Event $event)
	{
		$event->setActive(true);
		$this->updateEntity($event);

		return $this->representationResponse($this->get('api.main_transformer')->transform($event), Response::HTTP_ACCEPTED);
	}

	/**
	 * @param Event $event
	 *
	 * @ParamConverter("event", options={
	 *     "mapping": {
	 *        "eventId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function disableAction(Event $event)
	{
		$event->setActive(false);
		$this->updateEntity($event);

		return $this->representationResponse($this->get('api.main_transformer')->transform($event), Response::HTTP_ACCEPTED);
	}
}
