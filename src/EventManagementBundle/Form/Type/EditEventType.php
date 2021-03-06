<?php

namespace EventManagementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EditEventType
 * @package EventManagementBundle\Form\Type
 */
class EditEventType extends AbstractType
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
			->add('eventTerm', DateType::class, ['widget' => 'single_text'])
			->add('description', TextType::class)
			->add('latitude', NumberType::class)
			->add('longitude', NumberType::class)
			->add('address', TextType::class);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class'         => 'EventManagementBundle\Entity\Event',
			'csrf_protection'    => false,
			'allow_extra_fields' => true
		]);
	}
}