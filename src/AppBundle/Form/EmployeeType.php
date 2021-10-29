<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array('label'=>'Imię:'))
            ->add('surname',TextType::class,array('label'=>'Nazwisko:'))
            ->add('title',TextType::class,array('label'=>'Tytuł:'))
            ->add('role',TextType::class,array('label'=>'Rola:'))
            ->add('address',TextType::class,array('label'=>'Adres c.d.:'))
            ->add('postalcode',TextType::class,array('label'=>'Kod pocztowy:'))
            ->add('city',TextType::class,array('label'=>'Miejscowość:'))
            ->add('pesel',TextType::class,array('label'=>'PESEL:'))
            ->add('email',EmailType::class,array('label'=>'E-mail:'))
            ->add('isactive',TextType::class,array('label'=>'Aktywność:'))
            ->add('salary',MoneyType::class,array('label'=>'Wynagrodzenie (PLN):'))
            ->add('info',TextareaType::class,array('label'=>'Informacje:'))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_employee';
    }


}
