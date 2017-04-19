<?php
declare(strict_types = 1);

namespace ApiBundle\Request;

/**
 * Class PaginatedRequest
 * @package ApiBundle\Response
 */
class PaginatedRequest
{
	/**
	 * @var int
	 */
	private $limit;

	/**
	 * @var int
	 */
	private $page;

	/**
	 * @var string
	 */
	private $router;

	/**
	 * @return int
	 */
	public function getLimit(): int
	{
		return $this->limit;
	}

	/**
	 * @return int
	 */
	public function getPage(): int
	{
		return $this->page;
	}

	/**
	 * @param int $page
	 *
	 * @return PaginatedRequest
	 */
	public function setPage(int $page): PaginatedRequest
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * @param int $limit
	 *
	 * @return PaginatedRequest
	 */
	public function setLimit(int $limit): PaginatedRequest
	{
		$this->limit = $limit;

		return $this;
	}

	/**
	 * @param string $router
	 *
	 * @return PaginatedRequest
	 */
	public function setRouter(string $router): PaginatedRequest
	{
		$this->router = $router;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRouter(): string
	{
		return $this->router;
	}

}