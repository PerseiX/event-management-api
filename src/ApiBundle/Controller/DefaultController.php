<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Example;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
    	$example = new Example();
    	$example->setId(123);

    	$representation = $this->get('api.main_transformer')->transform($example);

        return new JsonResponse($representation);
    }
}
