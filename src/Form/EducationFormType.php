<?php

namespace App\Form;

use App\Entity\CvEducation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('institution', TextType::class, [
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('faculty', TextType::class, [
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('study_field', TextType::class, [
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('education_level', ChoiceType::class, [
                'placeholder' => 'Choose education level ...',
                'choices'  => [
                    'Elementary School' =>  'Elementary School',
                    'High School(Absolute)' =>  'High School(Absolute)',
                    'High School(Professional)' =>  'High School(Professional)',
                    'College' =>  'College',
                    'Professional Academic Degree' =>  'Professional Academic Degree',
                    'Bachelor’s Degree' =>  'Bachelor’s Degree',
                    'Master’s Degree' =>  'Master’s Degree',
                    'Doctorate Degree' =>  'Doctorate Degree'
                ],
                'attr' => [
                    'class' => 'h-10 shadow-lg block mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('status', ChoiceType::class, [
                'placeholder' => 'Choose status ...',
                'choices'  => [
                    'Finished' => true,
                    'Unfinished' => false
                ],
                'attr' => [
                    'class' => 'h-10 shadow-lg block mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('start_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            ->add('end_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'h-10 shadow-lg block p-4 mb-8 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',

                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'
                ]
            ])
            //->add('cv')
            ->add('Save', SubmitType::class, [
                'attr' => [
                    'class' => 'shadow-lg border-solid border border-black px-4 py-2 h-10 rounded float-right hover:text-black hover:bg-amber-600 transition duration-500 hover:scale-105'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CvEducation::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'base_info'
        ]);
    }
}
