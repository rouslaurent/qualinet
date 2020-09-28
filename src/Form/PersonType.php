<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('function', ChoiceType::class, [
                'choices' => $this->getFunctionChoices('function')
            ])
            ->add('site', ChoiceType::class, [
                'choices' => $this->getFunctionChoices('site')
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

    private function getFunctionChoices(string $field) {
        if($field == 'function'){
            $choices = Person::FUNCTIONS;
        } else if ($field == 'site'){
            $choices = Person::SITES;
        }
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
