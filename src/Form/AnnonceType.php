<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File as AssertFile;
use Symfony\Component\Validator\Constraints\Image as AssertImage;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('description',TextareaType::class,['attr'=>['class'=>'form-control']])
            ->add('prix',NumberType::class,['attr'=>['class'=>'form-control']])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'category','attr'=>['class'=>'form-controle']])
            //->add('createdAt',DateTimeType::class)
            ->add('photo',FileType::class,['attr'=>['class'=>'custom-file-input'],
                'label' => 'Télécharger la photo',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new AssertFile([
                        'maxSize'=> '1024k',
                        'mimeTypes' => [
                            'image/png', 'image/jpeg', 'image/gif'
                        ],
                        'maxSizeMessage' => 'Vous devez choisir un fichier de 5 Mo maximum',
                        'mimeTypesMessage' => 'Seuls les fichier image web sont autorisés',

                    ])
                ]

            ])

            ->add('submit',SubmitType::class,['label'=>'Valider','attr'=>['class'=>'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
