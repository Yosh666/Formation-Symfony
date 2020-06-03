<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom'
            ])
            ->add('firstname',TextType::class,[
                'label'=>'Prénom'
            ])
            ->add('birthday',DateType::class,[
                'label'=>'Date de naissance',
                'format'=>'dd-MM-yyyy',
                'years'=>range(date('Y')-100,date('Y')-18)

            ])
            ->add('mail',EmailType::class,[
                'required'=>true
            ])
            ->add('phone',TextType::class,[
                'label'=>'Téléphone: ',
                'attr'=>[
                    'maxlength'=>12,
                    'minlength'=>6
                ]
            ])
            ->add('sessions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
