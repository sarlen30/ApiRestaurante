<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class'=>Cliente::class]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('nombre', TextType::class)
             ->add('apellidos', TextType::class)
             ->add('telefono', TextType::class)
             ->add('user', EntityType::class, [
                 'class'=> User::class
             ])
         ;



    }

    public function getBlockPrefix()
    {
        return '';
    }
    public function getName(){
        return '';
    }


}