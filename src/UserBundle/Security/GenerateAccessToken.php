<?php

namespace UserBundle\Security;

use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use UserBundle\Model\AuthorizationCodeModel;
use GuzzleHttp\Client as Guzzle;

/**
 * Class GenerateAccessToken
 * @package ApiBundle\Security
 */
class GenerateAccessToken
{
	/**
	 * @var AuthorizationCodeModel
	 */
	private $authorizationCodeModel;

	/**
	 * @var
	 */
	private $guzzleClient;

	/**
	 * GenerateAccessToken constructor.
	 *
	 * @param AuthorizationCodeModel $authorizationCodeModel
	 * @param                        $guzzleClient
	 */
	public function __construct(AuthorizationCodeModel $authorizationCodeModel, Guzzle $guzzleClient)
	{
		$this->authorizationCodeModel = $authorizationCodeModel;
		$this->guzzleClient           = $guzzleClient;
	}

	/**
	 * @return string
	 */
	public function generateAccessTokens()
	{
		try {
			$request  = $this->guzzleClient->post(
				'http://localhost/event-management-api/web/app_dev.php/oauth/v2/token',
				[
					'form_params' => [
						'grant_type'    => $this->authorizationCodeModel->getGrantType(),
						'client_id'     => $this->authorizationCodeModel->getClientId(),
						'client_secret' => $this->authorizationCodeModel->getClientSecret(),
						'code'          => $this->authorizationCodeModel->getCode(),
						'redirect_uri'  => $this->authorizationCodeModel->getRedirectUri()[0]
					],
					'headers'     => [
						'Content-Type' => 'application/x-www-form-urlencoded'
					],
				]
			);
			$response = $request->getBody()->getContents();
		} catch (RequestException $exception) {
			throw new BadRequestHttpException('Was some problem during send request. '. $exception->getMessage());
		}

		return $response;
	}
}