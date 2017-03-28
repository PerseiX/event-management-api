<?php

namespace ApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TransformerScopeCompilerPass
 * @package ApiBundle\DependencyInjection
 */
class TransformerScopeCompilerPass implements CompilerPassInterface
{
	CONST TAG_NAME                          = "api.transformer_scope";
	CONST TRANSFORMER_SCOPE_REPOSITORY_NAME = "api.transformer_scope_repository";
	CONST METHOD                            = "addScope";

	/**
	 * You can modify the container here before it is dumped to PHP code.
	 *
	 * @param ContainerBuilder $container
	 */
	public function process(ContainerBuilder $container)
	{
		if (!$container->has(self::TRANSFORMER_SCOPE_REPOSITORY_NAME)) {
			return;
		}

		$taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);
		$definition     = $container->findDefinition(self::TRANSFORMER_SCOPE_REPOSITORY_NAME);

		foreach ($taggedServices as $id => $tags) {
			$definition->addMethodCall(self::METHOD, [
				new Reference($id)
			]);
		}
	}
}