<?php

namespace UserBundle\Subscriber;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * Class LogoutListener
 * @package UserBundle\Subscriber
 */
class LogoutListener implements LogoutHandlerInterface
{
	/**
	 * @var UserManagerInterface
	 */
	protected $userManager;

	/**
	 * LogoutListener constructor.
	 *
	 * @param UserManagerInterface $userManager
	 */
	public function __construct(UserManagerInterface $userManager)
	{
		$this->userManager = $userManager;
	}

	/**
	 * @param Request        $request
	 * @param Response       $response
	 * @param TokenInterface $token
	 */
	public function logout(Request $request, Response $response, TokenInterface $token)
	{
		die; //TODO Remove cookie
	}
}