<?php

namespace App\Form;

use App\Entity\Juego;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class JuegoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre',TextType::class,['attr' =>['class' => 'formuDiv']])
            ->add('editorial',textType::class, ['attr' =>['class' => 'formuDiv']])
            ->add('minimo',IntegerType::class, ['attr' =>['class' => 'formuDiv']])
            ->add('maximo',IntegerType::class, ['attr' =>['class' => 'formuDiv']])
            ->add('ancho',IntegerType::class, ['attr' =>['class' => 'formuDiv']])
            ->add('alto',IntegerType::class, ['attr' =>['class' => 'formuDiv']])
            ->add('imagen',FileType::class, ['data_class'=>null,'attr' =>['class' => 'formuDiv']])
            ->add('guardar',SubmitType::class, ['attr' =>['class' => 'formuDiv']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Juego::class,
        ]);
    }
}
