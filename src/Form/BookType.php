<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Reader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null,  [
              'label' => 'Title',
              'attr' => array('class'=>'input'),
            ])
            ->add('author', EntityType::class,  [
              'label' => 'Author',
              'class' => Author::class,
              'attr' => array('class'=>'input'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
