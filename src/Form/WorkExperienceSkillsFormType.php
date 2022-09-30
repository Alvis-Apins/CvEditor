<?php

namespace App\Form;

use App\Entity\CvJobExperienceSkills;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkExperienceSkillsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'placeholder' => 'Choose skill type ...',
                'choices'  => [
                    'Base-job' => 'Base-job',
                    'Extra skill' => 'Extra skill',
                    'Achievement' => 'Achievement'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'h-10 shadow-lg block mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('skill', TextType::class, [
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',

                ],
                'required' => false,
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('Save', SubmitType::class, [
                'attr' => [
                    'name' => 'action',
                    'value' => 'save',
                    'class' => 'shadow-lg border-solid border border-black px-4 py-2 h-10 rounded float-right hover:text-black hover:bg-amber-600 transition duration-500 hover:scale-105'
                ]
            ])
            ->add('Add-Skill', SubmitType::class, [
                'attr' => [
                    'name' => 'add',
                    'value' => 'add',
                    'class' => 'mx-2 shadow-lg border-solid border border-black px-4 py-2 h-10 rounded float-right hover:text-black hover:bg-amber-600 transition duration-500 hover:scale-105'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CvJobExperienceSkills::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'base_info'
        ]);
    }
}
