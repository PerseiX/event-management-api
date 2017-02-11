<?php

namespace ApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TransformerCompilerPass
 * @package ApiBundle\DependencyInjection
 */
class TransformerCompilerPass implements CompilerPassInterface
{
	const TAG_NAME              = 'api.transformer';
	const METHOD                = 'addTransformer';
	const MAIN_TRANSFORMER_NAME = 'api.main_transformer';

	/**
	 * @param ContainerBuilder $container
	 */
	public function process(ContainerBuilder $container)
	{
		if (!$container->has(self::MAIN_TRANSFORMER_NAME)) {
			return;
		}

		$taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);
		$definition     = $container->findDefinition(self::MAIN_TRANSFORMER_NAME);

		foreach ($taggedServices as $id => $tags) {
			$definition->addMethodCall(self::METHOD, [new Reference($id)]);
		}
	}
}