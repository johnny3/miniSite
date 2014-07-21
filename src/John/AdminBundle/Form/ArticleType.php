<?php

namespace John\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('updatedAt')
            ->add('slug')
            ->add('title')
            ->add('body')
            ->add('picture')
            ->add('video')
            ->add('category')
            ->add('subCategory')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'John\AdminBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'john_adminbundle_articletype';
    }
}
