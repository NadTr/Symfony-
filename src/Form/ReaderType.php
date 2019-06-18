<?php

namespace App\Form;

use App\Entity\Reader;
use App\Entity\Book;
use App\Entity\Tea;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('age')
            ->add('tea')
            ->add('books')
          // ->add('tea', EntityType::class, [
          //       'required' => false,
          //       'label' => false,
          //       'class' => Tea::class,
          //       'choice_label' => 'tea',
          //       'multiple' => false
          //   ])
          //   ->add('books', EntityType::class, [
          //       'required' => false,
          //       'label' => false,
          //       'class' => Book::class,
          //       'choice_label' => 'name',
          //       'multiple' => true
          //   ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Reader::class,
        ));
    }
}
