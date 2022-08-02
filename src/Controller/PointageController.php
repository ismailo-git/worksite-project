<?php

namespace App\Controller;

use App\Entity\Pointages;
use App\Form\PointageFormType;
use Flasher\Prime\FlasherInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PointageController extends AbstractController
{   

    /**
     * @Route("/pointages", name="pointage")
     */
    public function index(): Response
    {    
        $repository = $this->getDoctrine()->getRepository(Pointages::class);
        $pointages = $repository->findAll();
        return $this->render('pointage/index.html.twig', [

            'pointages' => $pointages,
        
        ]);
    }

    /**
     * @Route("/pointages/create", name="create_pointage")
     */
    public function create(Request $request, FlasherInterface $flasher): Response
    {   
        $pointage = new Pointages();

        $form = $this->createForm(PointageFormType::class, $pointage);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            
            $pointage->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pointage);
            $entityManager->flush();
            $flasher->addSuccess('Vous avez pointer ce chantier avec succes');
            return $this->redirectToRoute('pointage');
        
        }
       
        return $this->render('pointage/create.html.twig', [
            
            'formPointage' => $form->createView()
        ]);
    }

    
}
