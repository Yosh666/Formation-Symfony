
        //COL JS

        /*cette fonction va prendre en charge deux choses :
        -la création d'un bouton supprimer pr chaque ProgrammeType
        - la gestion du click


         $form = un formulaire ProgrammeType
        */
       //ASK estce ke c twig qui sait ke $form c le form ProgrammeType?
       function putDeleteButton($form) {

            //on crée un élément HTML bouton
            let $deleteButton = $('<button type="button">Supprimer</button>')

            //pn l'ajoute à la fin du contenu du form en paramétre
            //ASK prkoi en paramétre?
            $form.append($deleteButton)

            //on lui accroche un evenement click
            $deleteButton.on('click',function(){
                //qui supprimera du DOM le form 
                /*supprimera du DOM il faudra valider le form session pr le supprimer de la bdd*/
                $form.remove()
            })
       }

       //lorsk la page est interprété par le navigateur
       //DOM construit à 100%
       $(document).ready(function(){

            //on récupére l'élément HTML  qui contient tous les ProgrammeType
            $collectionForms=$('#programmes');

            //grace à la classe programmeForm identifié dans twig
            $collectionForms.find('.programmeForm').each(function(){
            //pr each des programmeForm on va rajouter un bouton suppress
                putDeleteButton($(this));
            })
            
            //on récupère dansune varible le bouton "addbutton"
            let $addButton= $("#addButton")

            $addButton.on("click",(event)=>{

                //on désactive l'event par default car de base kan on va cliquer sur un bouton ça va vouloir submit
                event.preventDefault()

                /*on stocke dans une variable le protype contenu dans la collection
                aka: le modéle HTML d'un ProgrammeType côté client*/
                let $newProgrammeForm=$("#programmes").data("prototype")

                //on crée un compteur qui contient le nbre d'enfants de la collection
                //du coup on ne se servira pas de :data-widget-counter
                let counter= $("#programmes").children().length
                //$counter= le nbre d'enfants de la div #programmes

                /*la variable $newProgrammeForm contiendra l'élément du DOM du nouveau programmeType
                l'élément a été modifié pr lui donné une id unique counter ça c la doc symfony*/
                $newProgrammeForm = $($newProgrammeForm.replace(/_name_/g,counter))

                //on applique la le bouton delete avec la function putDeleteButton
                //pr ke chak nouveau programme aie son bouton supprimer dans sa div rien qu'a lui
                putDeleteButton($newProgrammeForm)

                //on ajoute pr finir a la fin du contenu actuel de la collection
                $("#programmes").append(

                    //le nouveau programme type avec le bon id grace au compteur + le boutton delete est intégré au dom
                    //avec les balises renseignée dans le data-widget-tags (voir vue)
                    $($("#programmes").data("widget-tags")).html($newProgrammeForm)
                )

                //on déplace le bouton ajouter un programme à la fin du contenu de la collection
                $("#programmes").append($addButton)
            })
            // la collection c'est tout les programme Type rempli ou pas contenu dans la div #programmes
            //pensez à inspecter
       })

