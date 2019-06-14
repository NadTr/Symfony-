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
            ->add('title')
            // ->add('author')
            ->add('author', EntityType::class, array(
                 'class' => Author::class,
                'label' => 'book.label.author',
                'mapped' => false,
                 'required'=> true
                ))
            ->add('readers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
