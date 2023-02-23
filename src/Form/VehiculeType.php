<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => '💬 Titre'
            ])
            ->add('brand', TextType::class, [
                'label' => '🚘 Marque'
            ])
            ->add('model', TextType::class, [
                'label' => '🚘 Modèle'
            ])
            ->add('content', TextType::class, [
                'label' => '💬 Description'
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => '📸 Photo du véhicule'
            ])
            ->add('price', TextType::class, [
                'label' => '🛒 Prix'
            ])
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
