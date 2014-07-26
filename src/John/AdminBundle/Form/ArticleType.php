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
                ->add('title', 'text')
                ->add('chapo', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'simple' // simple, advanced, bbcode
            )))
                ->add('body', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced' // simple, advanced, bbcode
            )))
                ->add('file')
                ->add('video')
                ->add('isVisible')
                ->add('isPicture', 'checkbox', array('data' => true))
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
