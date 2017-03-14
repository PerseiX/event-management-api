<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use UserBundle\DependencyInjection\UserExtension;

class UserBundle extends Bundle
{
	/**
	 * @return UserExtension
	 */
	public function getContainerExtension()
	{
		return new UserExtension();
	}
}
