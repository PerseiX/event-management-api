<?php

namespace EventManagementBundle\Form\Type;

use Nelmio\ApiDocBundle\Tests\Fixtures\Form\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class GuestType
 * @package EventManagementBundle\Form\Type
 */
class GuestType extends AbstractType
{
	/**
	 * {@override}
	 *
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class)
			->add('surname', TextType::class)
			->add('tag', EntityType::class, [
					'class'        => 'EventManagementBundle\Entity\Tag',
					'by_reference' => true,
					'multiple'     => true
				]
			)
			->add('event', EntityType::class, [
					'class'        => 'EventManagementBundle\Entity\Event',
					'by_reference' => true
				]
			);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class'         => 'EventManagementBundle\Entity\Guest',
			'csrf_protection'    => false,
			'allow_extra_fields' => true,
		]);
	}

	/**
	 * Returns the name of this type.
	 *
	 * @return string The name of this type
	 */
	function getName()
	{
		return '';
	}
}