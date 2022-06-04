<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Введите логин'
                ])
            ->add('mail', EmailType::class,[
                'label'=>'Введите email'
            ])
            ->add('phone', NumberType::class
                ,[
                'label'=>'Введите номер телефона'
            ])
            ->add('avatar', TextType::class, [
                'label'=>'Выберите аватарку'
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'type' => PasswordType::class,
                'required' => true,
                'first_options'=>['label' => 'Введите пароль'],
                'second_options'=>['label' => 'Повторите пароль'],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста, введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ваш пароль должен содержать не менее {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('submit',SubmitType::class,[
                'label'=>'Регистрация'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
