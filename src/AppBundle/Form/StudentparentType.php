<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class StudentparentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentname',TextType::class,array('label'=>'Imię:'))
            ->add('parentsurname',TextType::class,array('label'=>'Nazwisko:'))
            ->add('parentaddress',TextType::class,array('label'=>'Adres:'))
            ->add('parentphone',TextType::class,array('label'=>'Telefon:'))
            ->add('parentemail',EmailType::class,array('label'=>'E-mail:'))
            ->add('idstudent')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Studentparent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studentparent';
    }


}
