<?php

namespace App\Form;

use App\Entity\Hackathon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheHType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('nb_place')
            ->add('description')
            ->add('ville')
            ->add('rue')
            ->add('cp')
            ->add('image')
            ->add('date_debut')
            ->add('date_fin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hackathon::class,
        ]);
    }
}
