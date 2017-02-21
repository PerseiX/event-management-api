<?php

namespace EventManagementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EventType
 * @package EventManagementBundle\Form\Type
 */
class EventType extends AbstractType
{
	/**
	 * {@override}
	 *
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('isActive', ChoiceType::class, [
					'choices' => [
						'Yes' => true,
						'No'  => false,
					]
				])
		        ->add('createdAt', DateType::class, ['widget' => 'single_text'])
		        ->add('name', TextType::class)
		        ->add('eventTerm', DateType::class, ['widget' => 'single_text'])
		        ->add('description', TextType::class);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'csrf_protection' => false,
		]);
	}
}