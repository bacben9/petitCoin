<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Nom'])
            ->add('firstName',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Prenom'])
            ->add('email',EmailType::class,['attr'=>['class'=>'form-control'],'label'=>'Email'])


            ->add('plainPassword', PasswordType::class, ['attr'=>['class'=>'form-control'],'label'=>'Mot de passe',

                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez inserer un mot de passe ',]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir {{ limit }} de caractéres',
                        'max' => 4096,]),
                ],
            ])

        ->add('submit',SubmitType::class,['attr'=>['class'=>'btn btn-primary'],'label'=>'Valider']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
