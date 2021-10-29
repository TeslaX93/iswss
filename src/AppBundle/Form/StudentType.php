<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StudentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array('label'=>'Imię:'))
            ->add('surname',TextType::class,array('label'=>'Nazwisko:'))
            ->add('gender',TextType::class,array('label'=>'Płeć:'))
            ->add('address',TextType::class,array('label'=>'Adres:'))
            ->add('postalcode',TextType::class,array('label'=>'Kod pocztowy:'))
            ->add('city',TextType::class,array('label'=>'Miejscowość:'))
            ->add('pesel',TextType::class,array('label'=>'PESEL:'))
            ->add('birthplace',TextType::class,array('label'=>'Miejsce urodzenia:'))
            ->add('birthdate',BirthdayType::class,array('label'=>'Data urodzenia:'))
            ->add('begindate',DateType::class,array('label'=>'Data rozpoczęcia:'))
            ->add('enddate',DateType::class,array('label'=>'Data zakończenia:'))
            ->add('phone',TextType::class,array('label'=>'Telefon:'))
            ->add('email',EmailType::class,array('label'=>'E-mail:'))
            ->add('isactive',TextType::class,array('label'=>'Aktywność:'))
            ->add('indivinfo',TextareaType::class,array('label'=>'Indywidualny tok:'))
            ->add('achivinfo',TextareaType::class,array('label'=>'Szczególne osiągnięcia:'))
            ->add('idschoolclass')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Student'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_student';
    }


}
