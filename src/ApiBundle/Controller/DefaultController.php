<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Example;
use ApiBundle\Model\ExampleModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	/**
	 * @Route("/")
	 */
	public function indexAction()
	{
		$example = new Example();
		$example->setId(123);

		$example2 = new Example();
		$example2->setId(321);

		$representation = $this->get('api.main_transformer')->transform(new ExampleModel([$example, $example2]));

		return new JsonResponse($representation);
	}
}
