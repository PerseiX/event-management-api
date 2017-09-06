<?php
declare(strict_types = 1);

namespace EventManagementBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use ApiBundle\Request\PaginatedRequest;
use Doctrine\ORM\ORMException;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Entity\Guest;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Form\Type\GuestType;
use EventManagementBundle\Model\GuestCollectionModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SortAndFilterBundle\Annotation\Sort;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ApiBundle\Annotation\Scope;

/**
 * Class GuestController
 * @package EventManagementBundle\Controller
 */
class GuestController extends AbstractApiController
{
	/**
	 * @param PaginatedRequest $paginatedRequest
	 * @param Event            $event
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Guests collection",
	 *     output="EventManagementBundle\Representation\GuestCollectionRepresentation"
	 * )
	 * @ParamConverter("event", options={
	 *      "mapping": {
	 *            "eventId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 *
	 * @Scope(scope="guest.tag")
	 * @Sort(availableField={"name", "createdAt", "id", "surname"}, alias="guest_repository", default="name")
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest, Event $event)
	{
		$query = $this->get('repository.guest')->guestsToEventCollectionQuery($event);

		return $this->paginatedResponse(GuestCollectionModel::class, $query, $paginatedRequest, ['eventId' => $event->getId()]);
	}

	/**
	 * @param PaginatedRequest $paginatedRequest
	 * @param Event            $event
	 * @param Tag              $tag
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Guests collection",
	 *     output="EventManagementBundle\Representation\GuestCollectionRepresentation"
	 * )
	 * @ParamConverter("event", options={
	 *      "mapping": {
	 *            "eventId" = "id"
	 *        }
	 * })
	 *
	 * @ParamConverter("tag", options={
	 *      "mapping": {
	 *            "tagId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 *
	 * @Scope(scope="guest.tag")
	 * @Sort(availableField={"name", "createdAt"}, alias="guest_repository", default="name")
	 */
	public function collectionByTagAction(PaginatedRequest $paginatedRequest, Event $event, Tag $tag)
	{
		$query = $this->get('repository.guest')->guestsToEventAndTagCollectionQuery($event, $tag);

		return $this->paginatedResponse(GuestCollectionModel::class, $query, $paginatedRequest, [
			'eventId' => $event->getId(),
			'tagId'   => $tag->getId()
		]);
	}

	/**
	 * @param Guest $guest
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Single guest",
	 *     output="EventManagementBundle\Representation\GuestRepresentation"
	 * )
	 *
	 * @ParamConverter("guest", options={
	 *      "mapping": {
	 *            "guestId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 *
	 * @Scope(scope="guest.tag")
	 */
	public function singleAction(Guest $guest)
	{
		return $this->representationResponse($this->transform($guest));
	}

	/**
	 * @param Request $request
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Create event",
	 *     output="EventManagementBundle\Representation\GuestRepresentation",
	 *     input={
	 *        "class" = "EventManagementBundle\Form\Type\GuestType",
	 *        "name" = ""
	 *     }
	 * )
	 *
	 * @return Response
	 */
	public function createAction(Request $request)
	{
		$guest = new Guest();
		$guest->setCreatedBy($this->getUser());

		$form = $this->createForm(GuestType::class, $guest);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Request $request
	 * @param Guest   $guest
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Edit guest",
	 *     output="EventManagementBundle\Representation\GuestRepresentation",
	 *     input={
	 *        "class" = "EventManagementBundle\Form\Type\GuestType",
	 *        "name" = ""
	 *     }
	 * )
	 *
	 * @ParamConverter("guest", options={
	 *     "mapping": {
	 *        "guestId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 * @throws ORMException
	 */
	public function editAction(Request $request, Guest $guest)
	{
		$form = $this->createForm(GuestType::class, $guest, ['method' => $request->getMethod()]);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Guest $guest
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Delete guest"
	 * )
	 *
	 * @ParamConverter("guest", options={
	 *     "mapping": {
	 *        "guestId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function deleteAction(Guest $guest)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($guest);
		$em->flush();

		return $this->response(Response::HTTP_NO_CONTENT);
	}

	/**
	 * @param Guest $guest
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Enable guest"
	 * )
	 *
	 * @ParamConverter("guest", options={
	 *     "mapping": {
	 *        "guestId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function enableAction(Guest $guest)
	{
		$guest->setActive(true);
		$this->updateEntity($guest);

		return $this->representationResponse($this->transform($guest), Response::HTTP_ACCEPTED);
	}

	/**
	 * @param Guest $guest
	 *
	 * @ApiDoc(
	 *     section="Guests",
	 *     resource=true,
	 *     description="Disable guest"
	 * )
	 *
	 * @ParamConverter("guest", options={
	 *     "mapping": {
	 *        "guestId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function disableAction(Guest $guest)
	{
		$guest->setActive(false);
		$this->updateEntity($guest);

		return $this->representationResponse($this->transform($guest), Response::HTTP_ACCEPTED);
	}
}