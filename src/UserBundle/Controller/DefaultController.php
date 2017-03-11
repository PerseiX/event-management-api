<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
	/**
	 * @Route("/authorize")
	 */
	public function authorizeAction()
	{
		return $this->render('UserBundle:Default:index.html.twig', [
			'client' => [
				'id'            => $this->getParameter('id'),
				'redirect_url'  => $this->getParameter('redirect_url'),
				'response_type' => $this->getParameter('response_type')
			]
		]);
	}
}
