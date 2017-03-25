<?php

namespace UserBundle\Controller;

use ApiBundle\Entity\AccessToken;
use ApiBundle\Entity\RefreshToken;
use ApiBundle\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Model\AuthenticatedUserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AuthenticateController extends AbstractApiController
{
	/**
	 * @return Response
	 */
	public function authorizeAction(): Response
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
	public function codeAction(Request $request): JsonResponse
	{
		$this->get('code_resolver')->resolve($request->get('code'));
		$response = $this->get('generate_access_token')->generateAccessTokens();

		return new JsonResponse($response);
	}

	/**
	 * @param AccessToken  $accessToken
	 * @param RefreshToken $refreshToken
	 *
	 * @return Response
	 *
	 * @ParamConverter("accessToken", options={
	 *     "mapping": {
	 *        "accessToken" = "token"
	 *      }
	 * })
	 *
	 * @ParamConverter("refreshToken", options={
	 *     "mapping": {
	 *        "refreshToken" = "token"
	 *      }
	 * })
	 */
	public function userDetailAction(AccessToken $accessToken, RefreshToken $refreshToken): Response
	{
		$authenticatedUser = new AuthenticatedUserModel($accessToken, $refreshToken);

		return $this->representationResponse($this->get('api.main_transformer')->transform($authenticatedUser));
	}
}
