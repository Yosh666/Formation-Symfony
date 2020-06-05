<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\ProgrammeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'choice_label'=>function(Stagiaire $stagiaire){
                    return $stagiaire->getName().' '.$stagiaire->getFirstname();
                },
                
                "expanded"=>true,
                'multiple'=>true,
                "required"=>false
            ])
            
            //FIXME
            /*->add('programmes',CollectionType::class,[
                'entry_type'=>ProgrammeType::class          
               
            ])*/
            /*BUG
            et si on passait par une page spéciale pr le programme de chaque session de formation 
            penser make:crud programme*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
