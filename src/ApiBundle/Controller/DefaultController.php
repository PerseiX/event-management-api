<?php

namespace ApiBundle\Controller;

use ApiBundle\Model\ExampleModel;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FOSRestController
{
	/**
	 * @return Response
	 */
	public function getExampleAction()
	{
		$examples       = $this->getDoctrine()->getRepository('ApiBundle:Example')
		                       ->findAll();
		$representation = $this->get('api.main_transformer')->transform(new ExampleModel($examples));

		$view = $this->view($representation, Response::HTTP_OK);

		return $this->handleView($view);
	}
}
