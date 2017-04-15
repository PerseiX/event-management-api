<?php

namespace EventManagementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CreateTagType
 * @package EventManagementBundle\Form\Type
 */
class TagType extends AbstractType
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
			->add('name', TextType::class);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class'         => 'EventManagementBundle\Entity\Tag',
			'csrf_protection'    => false,
			'allow_extra_fields' => true
		]);
	}
}