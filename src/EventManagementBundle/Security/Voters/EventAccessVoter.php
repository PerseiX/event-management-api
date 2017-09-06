<?php
declare(strict_types=1);

namespace EventManagementBundle\Security\Voters;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Security\Voter\AbstractVoter;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Representation\EventRepresentation;
use JMS\Serializer\Exception\LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class EventAccessVoter
 * @package EventManagementBundle\Security\Voters
 */
class EventAccessVoter extends AbstractVoter
{
	/**
	 * @return array
	 */
	protected function getSupportedClass(): array
	{
		return [
			Event::class,
			EventRepresentation::class
		];
	}

	/**
	 * @return array
	 */
	protected function getSupportedPermissions(): array
	{
		return [
			self::CREATE,
			self::EDIT,
			self::VIEW,
			self::VIEW_COLLECTION,
			self::DELETE,
			self::DISABLE,
			self::ENABLE
		];
	}

	/**
	 * @param string         $attribute
	 * @param mixed          $subject
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
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
	protected function canEdit($event, TokenInterface $token): bool
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
	protected function canCreate($event, TokenInterface $token): bool
	{
		return $this->decisionManager->decide($token, ['ROLE_USER'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canViewCollection($event, TokenInterface $token): bool
	{
		//TODO ALl user can view collection? Return collection per user
		return $this->decisionManager->decide($token, ['ROLE_USER'], $event);
	}

	/**
	 * @param                $event
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function canDelete($event, TokenInterface $token): bool
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
	protected function canView($event, TokenInterface $token): bool
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
	protected function canEnable($event, TokenInterface $token): bool
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
	protected function canDisable($event, TokenInterface $token): bool
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