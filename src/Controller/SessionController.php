<?php

namespace App\Controller;
use App\Entity\Stagiaire;
use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/session")
 */
class SessionController extends AbstractController
{
    /**
     * @Route("/", name="session_index", methods={"GET"})
     */
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findAll(),
        ]);
    }


   

    /**
     * @Route("/new", name="session_new" )
     * @Route("/{id}/edit", name="session_edit")
     */
    public function edit( Session $session= null, Request $request): Response
    {
        if($session == null){
            $session= new Session();
            $mode = "new";
        }
        else{
            $mode = "edit";
        }
        $form = $this->createForm(SessionType::class, $session);
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(count($form->get("stagiaires")->getData()) > $form->get("nb_seat")->getData()){
                $this->addFlash("error","vous avez inscrit trop de stagiaires");
                return $this->redirectToRoute('session_edit', ['id' => $session->getId()]);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            $this->addFlash("success","Bravo t'as modifié un truc \o/");
            return $this->redirectToRoute('session_index');

        }

        return $this->render('session/edit.html.twig', [
            'session' => $session,
            'form'    => $form->createView(),
            'mode'    => $mode
        ]);
    }

    /**
     * @Route("/{id}/delete", name="session_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Session $session): Response
    {
        if ($this->isCsrfTokenValid('delete'.$session->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($session);
            $entityManager->flush();
        }

        return $this->redirectToRoute('session_index');
    }
     /**
     * @Route("/{id}", name="session_show", methods={"GET"})     * 
     */
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }
}
