<?php

namespace UserBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractApiController
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
	 * @Route("/addClient", name="_adduser")
	 */
	public function addclientAction()
	{
		$clientManager = $this->get('fos_oauth_server.client_manager.default');
		$client        = $clientManager->createClient();
		$client->setRedirectUris(['http://localhost/event-management-api/web/app_dev.php/code']);
		$client->setAllowedGrantTypes(['authorization_code', 'refresh_token']);
		$client->setName('Event Management');
		$clientManager->updateClient($client);
		$output = sprintf("Added client with id: %s secret: %s", $client->getPublicId(), $client->getSecret());

		return new Response($output);
	}
}
