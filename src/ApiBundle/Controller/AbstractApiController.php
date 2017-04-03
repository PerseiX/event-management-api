<?php

namespace ApiBundle\Controller;

use ApiBundle\Representation\AbstractRepresentationCollection;
use ApiBundle\Representation\RepresentationInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\Representation\PaginatedRepresentation;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractApiController
 * @package ApiBundle\Controller
 */
class AbstractApiController extends FOSRestController
{
	/**
	 * @param         $class
	 * @param Query   $query
	 * @param Request $request
	 * @param array   $parameters
	 *
	 * @return Response
	 */
	protected function paginatedResponse($class, Query $query, Request $request, $parameters = [])
	{
		$limit = $request->get('limit');
		$page  = $request->get('page');

		$paginator = $this->get('knp_paginator');

		/** @var SlidingPagination $pagination */
		$pagination = $paginator->paginate($query, $page, $limit, $parameters);

		$representation = $this->get('api.main_transformer')->transform(new $class($pagination->getItems()));

		$paginatedRepresentation = new PaginatedRepresentation(
			$representation,
			$request->get('_route'),
			$parameters,
			$page,
			$limit,
			round($pagination->getTotalItemCount() / $limit)
		);

		return $this->representationResponse($paginatedRepresentation);
	}

	/**
	 * @param     $input
	 * @param int $status
	 *
	 * @return Response
	 */
	protected function representationResponse($input, $status = Response::HTTP_OK)
	{
		$view = $this->view($input, $status);

		return $this->handleView($view);
	}

	/**
	 * @param $statusCode
	 *
	 * @return Response
	 */
	public function response($statusCode)
	{
		return $this->handleView($this->view(null, $statusCode));
	}

	/**
	 * @param Request $request
	 * @param Form    $form
	 *
	 * @return Response
	 * @throws ORMException
	 */
	protected function formResponse(Request $request, Form $form)
	{
		$form->handleRequest($request);

		$clearMissing = true;
		if ('PUT' === $request->getMethod()) {
			$clearMissing = false;
		}

		if (false === $form->isSubmitted()) {
			$form->submit($request->request->all(), $clearMissing);
		}

		if (true === $form->isValid()) {
			$manager = $this->getDoctrine()->getManager();
			$manager->beginTransaction();
			try {
				$input = $form->getData();

				$manager->persist($input);
				$manager->flush();
				$manager->commit();
			} catch (ORMException $exception) {
				$manager->rollback();
				throw $exception;
			}

			return $this->representationResponse($this->get('api.main_transformer')->transform($input));
		}

		return $this->formErrorsResponse($form);
	}

	/**
	 * @param Form $form
	 *
	 * @return Response
	 */
	protected function formErrorsResponse(Form $form)
	{
		$view = $this->view($this->getErrorMessages($form), 400);

		return $this->handleView($view);
	}

	/**
	 * @param Form $form
	 *
	 * @return array
	 */
	protected function getErrorMessages(Form $form)
	{
		$errors = [];

		foreach ($form->getErrors() as $key => $error) {
			if ($form->isRoot()) {
				$errors['#'][] = $error->getMessage();
			} else {
				$errors[] = $error->getMessage();
			}
		}

		foreach ($form->all() as $child) {
			if (!$child->isValid()) {
				$errors[$child->getName()] = $this->getErrorMessages($child);
			}
		}

		return $errors;
	}

	/**
	 * @param $entity
	 */
	protected function updateEntity($entity)
	{
		$em = $this->getDoctrine()->getManager();
		$em->persist($entity);
		$em->flush();
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	protected function transform($input): RepresentationInterface
	{
		return $representation = $this->get('api.main_transformer')->transform($input);
	}
}