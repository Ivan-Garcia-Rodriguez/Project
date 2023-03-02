<?php

namespace App\Form;

use App\Entity\Reserva;
use App\Entity\Juego;
use App\Entity\Mesa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FechaHora',DateTimeType::class,['widget' => 'single_text', 'empty_data'=>''])
            ->add('mesa',EntityType::class,['class' => Mesa::class, 'choice_label' => 'id'])
            ->add('juego',EntityType::class,['class' => Juego::class, 'choice_label' => 'Nombre'])
            ->add('Reservar',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
