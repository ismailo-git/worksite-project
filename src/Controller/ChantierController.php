<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Form\ChantierFormType;
use Flasher\Prime\FlasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ChantierController extends AbstractController
{
    /**
     * @Route("/chantiers", name="chantier")
     */
    public function index(): Response
    {   
        $repository = $this->getDoctrine()->getRepository(Chantier::class);
        $chantiers = $repository->findAll();
        return $this->render('chantier/index.html.twig', [

            'chantiers' => $chantiers
        ]);
    }

    /**
     * @Route("/chantiers/create", name="chantier_create")
     */
    public function create(Request $request,FlasherInterface $flasher): Response
    {  
        $chantier = new Chantier();

        $form = $this->createForm(ChantierFormType::class, $chantier);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $chantier = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();
            $flasher->addSuccess('Vous avez créez un chantier avec succes');
            return $this->redirectToRoute('chantier');
        }
       
        return $this->render('chantier/create.html.twig', [

            'chantier_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/chantiers/delete/{id}", name="chantier_delete")
     */
    public function delete($id, FlasherInterface $flasher): Response
    {   
        $entityManager = $this->getDoctrine()->getManager();
        $chantier = $entityManager->getRepository(Chantier::class)->find($id);
        $entityManager->remove($chantier);
        $entityManager->flush();
        $flasher->addSuccess("Vous avez supprimé un chantier");
        return $this->redirectToRoute('chantier');
    }

    /**
     * @Route("/chantiers/{id}", name="chantier_show")
     */
    public function show($id): Response
    {  
        $chantier = $this->getDoctrine()->getRepository(Chantier::class)
        ->find($id);

        if (!$chantier) {
            
            throw $this->createNotFoundException("Le chantier recherché n'existe pas");
        }

        return $this->render('chantier/show.html.twig', [

            'chantier' => $chantier
        ]);
    }

     /**
     * @Route("/chantiers/edit/{id<[0-9]+>}", name="chantier_edit")
     */
    public function edit(Request $request,$id, FlasherInterface $flasher): Response
    {  
        
        $chantier = new Chantier();
        $chantier = $this->getDoctrine()->getRepository(Chantier::class)->find($id);

        $form = $this->createForm(ChantierFormType::class, $chantier);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $flasher->addSuccess('Le chantier a été modifé avec succées');
            return $this->redirectToRoute('chantier');
        }
        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

     
}
