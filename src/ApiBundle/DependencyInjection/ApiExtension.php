<?php

namespace ApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class UserBundleExtension
 * @package UserBundle\DependencyInjection
 */
class ApiExtension extends Extension
{
	/**
	 * @param array            $configs
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');
		$loader->load('resolvers.yml');
		$loader->load('annotations.yml');
	}
}