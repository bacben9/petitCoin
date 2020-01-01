<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Nom'])
            ->add('firstName',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Prenom'])
            ->add('email',EmailType::class,['attr'=>['class'=>'form-control'],'label'=>'Email'])




            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('attr'=>['class'=>'form-control'],'label'=>'Veuillez inserer votre mot de passe:'),
                'second_options' => array('attr'=>['class'=>'form-control'],'label' => 'Veuillez réinsérer votre mot de passe :'),


            ))



        ->add('submit',SubmitType::class,['attr'=>['class'=>'btn btn-primary'],'label'=>'Valider']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
