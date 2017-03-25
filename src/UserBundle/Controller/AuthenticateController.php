<?php

namespace UserBundle\Controller;

use ApiBundle\Entity\AccessToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiBundle\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthenticateController extends AbstractApiController
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
				'response_type' => $this->getParameter('response_type'),
			]
		]);
	}

	/**
	 * @param Request $request
	 * @Route("/code", name="code")
	 *
	 * @return JsonResponse
	 */
	public function codeAction(Request $request)
	{
		$this->get('code_resolver')->resolve($request->get('code'));
		$response = $this->get('generate_access_token')->generateAccessTokens();

		return new JsonResponse($response);
	}

	/**
	 *
	 * @param Request $reuest
	 */
	public function userDetailAction(AccessToken $accessToken)
	{

	}
}
