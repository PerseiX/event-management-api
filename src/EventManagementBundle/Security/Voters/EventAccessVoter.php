<?php
declare(strict_types = 1);
namespace EventManagementBundle\Security\Voters;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Security\Voter\AbstractVoter;
use EventManagementBundle\Entity\Event;
use EventManagementBundle\Representation\EventRepresentation;
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
			self::VIEW
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

		return $this->decisionManager->decide($token, ['ROLE_ADMIN'], $event);
	}
}