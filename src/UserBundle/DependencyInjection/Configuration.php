<?php

namespace UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class UserConfiguration
 * @package UserBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
	/**
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode    = $treeBuilder->root('user');

		$rootNode
			->children()
			->scalarNode('client_id')->defaultValue('')->end()
			->scalarNode('client_secret')->defaultValue('')->end()
			->scalarNode('grant_type')->defaultValue('')->end()
			->arrayNode('redirect_uri')
			->prototype('scalar')->end()
			->end()
			->end();

		return $treeBuilder;
	}
}