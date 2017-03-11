<?php

namespace UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Example\UserBundle\Entity\User
 *
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	/**
	 * @ORM\Column(type="string", length=25, unique=true)
	 */
	private $username;
	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;
	/**
	 * @ORM\Column(type="string", length=60, unique=true)
	 */
	private $email;
	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	public function __construct()
	{
		$this->isActive = true;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getSalt()
	{
		return null;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getRoles()
	{
		return ['ROLE_ADMIN'];
	}

	public function eraseCredentials()
	{
	}

	public function serialize()
	{
		return serialize([$this->id, $this->username, $this->password]);
	}

	public function unserialize($serialized)
	{
		list ($this->id, $this->username, $this->password,) = unserialize($serialized);
	}
}