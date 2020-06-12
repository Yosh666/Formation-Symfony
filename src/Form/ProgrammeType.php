<?php

namespace App\Form;
use App\Entity\Session;
use App\Entity\Blocmodule;
use App\Entity\Programme;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('duree',IntegerType::class,[
                'label'=>"durée en jours"
            ])
            ->add('blocmodule',EntityType::class,[
                'class'=>Blocmodule::class,
                'label'=>'module',
                'choice_label'=>function(Blocmodule $module){
                    return $module->getName();
                },
                
                'expanded'=>true,
                'multiple'=>false,
                'required'=>true
            ])
            /*->add('session',EntityType::class,[
                'class'=>Session::class,
                'label'=>'Dans la formation',
                'choice_label'=>function(Session $session){
                    return $session->getTitle();
                },
                'expanded'=>true,
                'multiple'=>false,
                'required'=>true
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
