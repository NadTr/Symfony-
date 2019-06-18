<?php

namespace App\Form;

use App\Entity\Tea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,  [
              'label' => 'Nom',
              'attr' => array('class'=>'input'),
            ])
            ->add('origin', null,  [
              'label' => 'Origine',
              'attr' => array('class'=>'input'),
            ])
            ->add('color', null,  [
              'label' => 'Couleur',
              'attr' => array('class'=>'input'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tea::class,
        ));
    }
}
