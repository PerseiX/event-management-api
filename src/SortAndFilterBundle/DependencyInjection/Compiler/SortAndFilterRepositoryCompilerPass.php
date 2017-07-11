<?php
declare(strict_types=1);

namespace SortAndFilterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class SortAndFilterRepositoryCompilerPass
 * @package SortAndFilterBundle\DependencyInjection\Compiler
 */
class SortAndFilterRepositoryCompilerPass implements CompilerPassInterface
{
	CONST TAG_ID = 'api.sort_and_filtered_repository';

	/**
	 * @param ContainerBuilder $container
	 *
	 * @throws \Exception
	 */
	public function process(ContainerBuilder $container)
	{
		$taggedServiceIds = $container->findTaggedServiceIds(self::TAG_ID);

		foreach ($taggedServiceIds as $id => $tagsCollection) {
			$container->getDefinition($id)->addMethodCall('setCustomerSorting', [
				new Reference('custom_sorting')
			]);
		}
	}
}