<?php

namespace John\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsletterSubscriberTownType extends NewsletterSubscriberType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('town', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'John\AdminBundle\Entity\NewsletterSubscriber'
        ));
    }

    public function getName()
    {
        return 'john_adminbundle_newslettersubscribertowntype';
    }
}
