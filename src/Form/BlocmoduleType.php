<?php

namespace App\Form;

use App\Entity\Blocmodule;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocmoduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom du module'
            ])
            ->add('categories',EntityType::class,[
                'class'=>Categorie::class,
                'label'=>'Catégorie',
                'choice_label'=>function(Categorie $categorie){
                    return $categorie->getName();
                },
                "expanded"=>true,
                "multiple"=>false,
                "required"=>true
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blocmodule::class,
        ]);
    }
}
