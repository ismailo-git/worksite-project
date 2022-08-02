<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Pointages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PointageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                     'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd.mm.yyyy',
                ]
            ])
            ->add('chantier', EntityType::class, [

                "label" => "Choisir un chantier",
                "class" => Chantier::class,
                'choice_label' => function(Chantier $chantier) {

                    return strtoupper($chantier->getName());
                }
            ])
            ->add('startsAt', TimeType::class, [

                'widget' => 'single_text',
                'attr' => [
                     'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker'
                ]
            ])
            ->add('endsAt', TimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointages::class,
        ]);
    }
}
