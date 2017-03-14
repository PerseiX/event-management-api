<?php

namespace UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class UserBundleExtension
 * @package UserBundle\DependencyInjection
 */
class UserExtension extends Extension
{
	/**
	 * @param array            $configs
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config        = $this->processConfiguration($configuration, $configs);

		$loader = new YamlFileLoader(
			$container,
			new FileLocator(__DIR__ . '/../Resources/config')
		);
		$loader->load('services.yml');

		$authorizationCodeModel = $container->getDefinition('authorization_code_model');
		$authorizationCodeModel->addMethodCall('setClientId', [$config['client_id']]);
		$authorizationCodeModel->addMethodCall('setClientSecret', [$config['client_secret']]);
		$authorizationCodeModel->addMethodCall('setRedirectUri', [$config['redirect_uri']]);
		$authorizationCodeModel->addMethodCall('setGrantType', [$config['grant_type']]);
	}
}