<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Vehicule;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startAt', DateType::class, [
                'label' => '📅 Date de départ',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'La date ne peut pas être antérieure à aujourd\'hui',
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date ne peut pas être antérieure à aujourd\'hui'
                    ])
                ]
            ])
            ->add('endAt', DateType::class, [
                'label' => '📅 Date de retour',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'La date ne peut pas être antérieure à aujourd\'hui',
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date ne peut pas être antérieure à aujourd\'hui'
                    ])
                ]
            ])
            // ->add('total')
            // ->add('createdAt')
            ->add('vehicules', EntityType::class, [
                'label' => '🚘 Véhicules',
                'class' => Vehicule::class,
                'choice_label' => 'title'
            ])
            // ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
