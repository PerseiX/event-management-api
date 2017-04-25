<?php
declare(strict_types = 1);

namespace ApiBundle\Resolver;

use ApiBundle\Request\PaginatedRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Class PaginatedRequestResolver
 * @package ApiBundle\Resolver
 */
class PaginatedRequestResolver implements ArgumentValueResolverInterface
{
	/**
	 * @var PaginatedRequest
	 */
	private $paginatedRequest;

	/**
	 * PaginatedRequestResolver constructor.
	 *
	 * @param PaginatedRequest $paginatedRequest
	 */
	public function __construct(PaginatedRequest $paginatedRequest)
	{
		$this->paginatedRequest = $paginatedRequest;
	}

	/**
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return bool
	 */
	public function supports(Request $request, ArgumentMetadata $argument): bool
	{
		return $argument->getType() === PaginatedRequest::class;
	}

	/**
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return \Generator
	 */
	public function resolve(Request $request, ArgumentMetadata $argument): \Generator
	{
		$this->paginatedRequest->setLimit((int)$request->query->get('limit', 20));
		$this->paginatedRequest->setPage((int)$request->query->get('page', 1));
		$this->paginatedRequest->setRouter($request->get('_route'));

		yield $this->paginatedRequest;
	}
}