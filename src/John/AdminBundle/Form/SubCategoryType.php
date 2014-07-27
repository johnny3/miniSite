<?php

namespace John\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SubCategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('isVisible')
                ->add('position')
                ->add('title')
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
                ->add('isPicture', 'checkbox', array('data' => true))
                ->add('metaTitle')
                ->add('metaDescription')
                ->add('category', 'entity', array(
                    'class' => 'JohnAdminBundle:Category',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->getVisibleCategoriesQueryBuilder(false);
                    }
                ))
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
