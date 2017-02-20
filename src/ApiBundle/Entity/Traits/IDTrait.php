<?php

namespace ApiBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class IDTrait
 * @package ApiBundle\Entity\Traits
 */
trait IDTrait
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
}