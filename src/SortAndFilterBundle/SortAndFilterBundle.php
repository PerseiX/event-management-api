<?php
declare(strict_types=1);

namespace SortAndFilterBundle;

use SortAndFilterBundle\DependencyInjection\Compiler\SortAndFilterRepositoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SortAndFilterBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new SortAndFilterRepositoryCompilerPass());
	}
}
