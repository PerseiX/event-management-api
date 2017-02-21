<?php

namespace ApiBundle\Controller;

use ApiBundle\Representation\RepresentationInterface;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstaracApiController
 * @package ApiBundle\Controller
 */
class AbstractApiController extends FOSRestController
{
	/**
	 * @param RepresentationInterface $representation
	 *
	 * @return Response
	 */
	protected function representationResponse(RepresentationInterface $representation)
	{
		$view = $this->view($representation, Response::HTTP_OK);

		return $this->handleView($view);
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

		if (false === $form->isSubmitted()) {
			$form->submit($request->request->all());
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
}