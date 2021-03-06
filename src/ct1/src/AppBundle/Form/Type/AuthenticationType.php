<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AuthenticationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('javascript:void(0);')
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('Register', SubmitType::class)
            ->add('Login', SubmitType::class);
    }
}
