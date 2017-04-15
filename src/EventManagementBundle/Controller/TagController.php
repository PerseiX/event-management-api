<?php

namespace EventManagementBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Doctrine\ORM\ORMException;
use EventManagementBundle\Entity\Tag;
use EventManagementBundle\Form\Type\TagType;
use EventManagementBundle\Model\TagModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class TagController
 * @package EventManagementBundle\Controller
 */
class TagController extends AbstractApiController
{
	/**
	 * @param Request $request
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Tags collection",
	 *     output="EventManagementBundle\Representation\TagsCollectionRepresentation"
	 * )
	 * @return Response
	 */
	public function collectionAction(Request $request)
	{
		$query = $this->getDoctrine()->getRepository('EventManagementBundle:Tag')
		              ->tagsCollectionQuery();

		return $this->paginatedResponse(TagModel::class, $query, $request);
	}

	/**
	 * @param Tag $tag
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Single tag",
	 *     output="EventManagementBundle\Representation\TagRepresentation"
	 * )
	 *
	 * @ParamConverter("tag", options={
	 *      "mapping": {
	 *            "tagId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 */
	public function singleAction(Tag $tag)
	{
		return $this->representationResponse($this->transform($tag));
	}

	/**
	 * @param Request $request
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Create tag",
	 *     output="EventManagementBundle\Representation\TagRepresentation",
	 *     input={
	 *        "class" = "EventManagementBundle\Form\Type\TagType",
	 *        "name" = ""
	 *     }
	 * )
	 *
	 * @return Response
	 */
	public function createAction(Request $request)
	{
		$form = $this->createForm(TagType::class, new Tag());

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Request $request
	 * @param Tag     $tag
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Edit tag",
	 *     output="EventManagementBundle\Representation\TagRepresentation",
	 *     input={
	 *        "class" = "EventManagementBundle\Form\Type\TagType",
	 *        "name" = ""
	 *     }
	 * )
	 *
	 * @ParamConverter("tag", options={
	 *     "mapping": {
	 *        "tagId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 * @throws ORMException
	 */
	public function editAction(Request $request, Tag $tag)
	{
		$form = $this->createForm(TagType::class, $tag, ['method' => $request->getMethod()]);

		return $this->formResponse($request, $form);
	}

	/**
	 * @param Tag $tag
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Delete tag"
	 * )
	 *
	 * @ParamConverter("tag", options={
	 *     "mapping": {
	 *        "tagId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function deleteAction(Tag $tag)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($tag);
		$em->flush();

		return $this->response(Response::HTTP_NO_CONTENT);
	}

	/**
	 * @param Tag $tag
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Enable tag"
	 * )
	 *
	 * @ParamConverter("tag", options={
	 *     "mapping": {
	 *        "tagId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function enableAction(Tag $tag)
	{
		$tag->setActive(true);
		$this->updateEntity($tag);

		return $this->representationResponse($this->transform($tag), Response::HTTP_ACCEPTED);
	}

	/**
	 * @param Tag $tag
	 *
	 * @ApiDoc(
	 *     section="Tags",
	 *     resource=true,
	 *     description="Disable tag"
	 * )
	 *
	 * @ParamConverter("tag", options={
	 *     "mapping": {
	 *        "tagId" = "id"
	 *      }
	 * })
	 *
	 * @return Response
	 */
	public function disableAction(Tag $tag)
	{
		$tag->setActive(false);
		$this->updateEntity($tag);

		return $this->representationResponse($this->transform($tag), Response::HTTP_ACCEPTED);
	}
}