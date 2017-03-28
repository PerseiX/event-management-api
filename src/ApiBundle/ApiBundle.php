<?php

namespace ApiBundle;

use ApiBundle\DependencyInjection\TransformerCompilerPass;
use ApiBundle\DependencyInjection\TransformerScopeCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiBundle extends Bundle
{
	/**
	 * @param ContainerBuilder $container
	 */
	public function build(ContainerBuilder $container)
	{
		$container->addCompilerPass(new TransformerCompilerPass());
		$container->addCompilerPass(new TransformerScopeCompilerPass());
	}
}
