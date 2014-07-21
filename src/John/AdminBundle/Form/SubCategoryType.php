<?php

namespace John\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubCategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('file')
                ->add('isPicture', 'checkbox', array('data' => true))
                ->add('body', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced' // simple, advanced, bbcode
            )))
                ->add('shortText', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'simple' // simple, advanced, bbcode
            )))
                ->add('position')
                ->add('category')
                ->add('isVisible')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'John\AdminBundle\Entity\SubCategory'
        ));
    }

    public function getName()
    {
        return 'john_adminbundle_subcategorytype';
    }

}
