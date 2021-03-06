<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = [
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
			new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
			new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
			new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new EventManagementBundle\EventManagementBundle(),
			new Symfony\Bundle\MonologBundle\MonologBundle(),
			new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
			new JMS\SerializerBundle\JMSSerializerBundle(),
			new SortAndFilterBundle\SortAndFilterBundle(),
			new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new FOS\UserBundle\FOSUserBundle(),
			new FOS\RestBundle\FOSRestBundle(),
			new UserBundle\UserBundle(),
			new ApiBundle\ApiBundle(),
		];

		if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
			$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			$bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
		}

		return $bundles;
	}

	public function getRootDir()
	{
		return __DIR__;
	}

	public function getCacheDir()
	{
		return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
	}

	public function getLogDir()
	{
		return dirname(__DIR__) . '/var/logs';
	}

	public function registerContainerConfiguration(LoaderInterface $loader)
	{
		$loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}
