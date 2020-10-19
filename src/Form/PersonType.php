<?php

namespace App\Form;

use App\Entity\Fonction;
use App\Entity\Localisation;
use App\Entity\Person;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('localisations', EntityType::class, [
                'class'=> Localisation::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('services', EntityType::class, [
                'class'=> Service::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('fonctions', EntityType::class, [
                'class'=> Fonction::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
            'translation_domain' => 'forms'
        ]);
    }
}
