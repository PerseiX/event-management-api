<?php
declare(strict_types = 1);

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
use ApiBundle\Annotation\Scope;

class EventController extends AbstractApiController
{
	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function collectionAction(Request $request)
	{
		$query = $this->getDoctrine()->getRepository('EventManagementBundle:Event')
		              ->eventsCollectionQuery();

		return $this->paginatedResponse(EventModel::class, $query, $request);
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
	 *
	 * @Scope(scope="event.user")
	 */
	public function singleAction(Event $event)
	{
		return $this->representationResponse($this->transform($event));
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
		$event->setUser($this->getUser());

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

		return $this->representationResponse($this->transform($event), Response::HTTP_ACCEPTED);
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

		return $this->representationResponse($this->transform($event), Response::HTTP_ACCEPTED);
	}
}
