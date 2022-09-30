<?php

namespace App\Form;

use App\Entity\CvPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file_name', FileType::class, [
                'label' => ' '
            ])
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
            'data_class' => CvPicture::class,
        ]);
    }
}
