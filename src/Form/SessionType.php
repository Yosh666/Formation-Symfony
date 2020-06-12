<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\ProgrammeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'label'=>'Nom de la formation'
            ])
            ->add('started_at',DateType::class,[
                'label'=>'Démarré le',
                'format'=>'dd-MM-yyyy',
                'years'=>range(date('Y')-2,date('Y')+5)

            ])
            ->add('ended_at',DateType::class,[
                'label'=>'fini le',
                'format'=>'dd-MM-yyyy',
                'years'=>range(date('Y')-2,date('Y')+5)

            ])
            ->add('nb_seat',IntegerType::class)
            ->add('stagiaires',EntityType::class,[
                'class'=>Stagiaire::class,
                'choice_label'=>function(Stagiaire $stagiaire)
                {
                    return $stagiaire->getName().' '.$stagiaire->getFirstname();
                },
                
                "expanded"=>true,
                'multiple'=>true,
                "required"=>false,
                "by_reference"=>false
            ])
            //COL on rajoute programmes dans le form
            ->add("programmes", CollectionType::class,[

                //la collection attend l'élément qu'elle entrera dans le form (ce n'est pas forcément un autre form)
                'entry_type'=> ProgrammeType::class,

                //ASK si c bien allow_add qui autorise le dataprototype
                /*on autorise l'ajoutde nouveaux éléments dans l'entité Session
                qui seront persister grace au cascade {"persist"} sur l'élément programmes
                ça active le data-prototype qui sera un attribut HTML avec lequel on pourra jouer en JS
                ASK demandez + de détails sur le data-prototype*/
                "allow_add"=>true,
                
                //On autorise aussi la suppression d'élément programmen dans l'entité session
                "allow_delete"=>true,
                
                /*OBLIGATOIRE car Session n'a pas de setProgramme mais c'est Programme
                qui contient SetSession car propriétaire de la relation 
                vérifier la bdd pr savoir qui est propriétaire
                donc pr éviter un mapping faux on est obligé de rajouter ça*/
                "by_reference"=>false,

                //des options pr personnaliser l'affichage de chaq élément et que ça soit plus ou moins moche
                //on peut faire sans mais au moins virer le label chelou c'est ici
                'entry_options'=>[
                    'label'=>false,
                ]


            ])
            ;
   }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
