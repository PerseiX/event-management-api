<?php

namespace UserBundle\Entity\Traits;

use UserBundle\Entity\User;

/**
 * Class UserTrait
 * @package UserBundle\Entity\Traits
 */
trait UserTrait
{
	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @param User $user
	 *
	 * @return $this
	 */
	public function setUser(User $user)
	{
		$this->user = $user;

		return $this;
	}
}