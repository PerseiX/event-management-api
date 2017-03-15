<?php

namespace UserBundle\Subscriber;

use FOS\OAuthServerBundle\Event\OAuthEvent;

/**
 * Class ConfirmationWindow
 * @package UserBundle\Subscriber
 */
class ConfirmationWindow
{
	/**
	 * @param OAuthEvent $event
	 */
	public function onPreAuthorizationProcess(OAuthEvent $event)
	{
		$event->setAuthorizedClient(true);
	}
}