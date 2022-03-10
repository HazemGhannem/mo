<?php

namespace App\Form;

use App\Entity\CV;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add('mail',EmailType::class)
        ->add('titredeprofil',TextType::class)
        ->add('telephone',IntegerType::class)
        ->add('adresse',TextType::class)
        ->add('ville',TextType::class)
        ->add('Formation',TextType::class)
        ->add('Experience',TextType::class)
        ->add('Valider',SubmitType::class);}
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CV::class,
        ]);
    }
}
