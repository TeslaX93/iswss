<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SchoolType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array('label'=>'Nazwa:'))
            ->add('patron',TextType::class,array('label'=>'Patron (dopełniacz): '))
            ->add('type',TextType::class,array('label'=>'Typ:'))
            ->add('number',TextType::class,array('label'=>'Numer:'))
            ->add('address',TextType::class,array('label'=>'Adres:'))
            ->add('postalcode',TextType::class,array('label'=>'Kod pocztowy:'))
            ->add('city',TextType::class,array('label'=>'Miasto:'))
            ->add('state',TextType::class,array('label'=>'Województwo:'))
            ->add('isactive',TextType::class,array('label'=>'Aktywność:'))
            ->add('info',TextareaType::class,array('label'=>'Informacje:'))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\School'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_school';
    }


}
