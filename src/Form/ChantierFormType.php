<?php

namespace App\Form;

use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [

                'attr' => [

                    "placeholder" => "Nom du chantier",
                    "class" => "form-control"
                ]
            ])
            ->add('address', TextType::class, [
                
                "attr" => [

                    "placeholder" => "Adresse du chantier",
                    "class" => "form-control"
                ]
            ])
            ->add('startsAt', DateTimeType::class, [

                'label' => "Démarrage du chantier",
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
            'data_class' => Chantier::class,
        ]);
    }
}
