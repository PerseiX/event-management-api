<?php
declare(strict_types = 1);
namespace EventManagementBundle\Security\Voters;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Security\Voter\AbstractVoter;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Representation\EventRepresentation;
use JMS\Serializer\Exception\LogicException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class EventAccessVoter
 * @package EventManagementBundle\Security\Voters
 */
class EventAccessVoter extends AbstractVoter
{
	/**
	 * @param string $attribute
	 * @param mixed  $subject
	 *
	 * @return bool
	 */
	protected function supports($attribute, $subject)
	{
		if (!$subject instanceof Event and !$subject instanceof EventRepresentation) {
			return false;
		}

		$supportedAction = [
			self::CREATE,
			self::EDIT,
			self::VIEW,
			self::VIEW_COLLECTION,
			self::DELETE,
			self::DISABLE,
			self::ENABLE
		];

		return in_array($attribute, $supportedAction);
	}

	/**
	 * @param string         $attribute
	 * @param mixed          $subject
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
	{
		$event = $subject;
		if ($subject instanceof RepresentationInterface) {
			$event = $this->getReferredObject(Event::class);
		}

		switch ($attribute) {
			case self::CREATE: {
				return $this->canCreate($event, $token);
			}
			case self::EDIT: {
				return $this->canEdit($event, $token);
			}
			case self::VIEW: {
				return $this->canView($event, $token);
			}
			case self::VIEW_COLLECTION: {
				return $this->canViewCollection($event, $token);
			}
			case self::DELETE: {
				return $this->canDelete($event, $token);
			}
			case self::DISABLE: {
				return $this->canDisable($event, $token);
			}
			case self::ENABLE: {
				return $this->canEnable($event, $token);
			}
		}

		throw new LogicException("This code couldn't reach");
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canEdit($event, TokenInterface $token)
	{
		/** @var Event $event */
		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canCreate($event, TokenInterface $token)
	{
		/** @var Event $event */
		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canViewCollection($event, TokenInterface $token)
	{
		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canDelete($event, TokenInterface $token)
	{
		/** @var Event $event */
		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canView($event, TokenInterface $token)
	{
		$event = $this->em->getRepository('EventManagementBundle:Event')->getEventWithUser($event);

		/** @var Event $event */
		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canEnable($event, TokenInterface $token)
	{
		$event = $this->em->getRepository('EventManagementBundle:Event')->getEventWithUser($event);

		/** @var Event $event */
		if ($event->getActive() === true) {
			return false;
		}

		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canDisable($event, TokenInterface $token)
	{
		$event = $this->em->getRepository('EventManagementBundle:Event')->getEventWithUser($event);

		/** @var Event $event */
		if ($event->getActive() === false) {
			return false;
		}

		if ($event->getUser() === $token->getUser()) {
			return true;
		}

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}
}