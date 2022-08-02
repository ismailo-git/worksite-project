<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{   
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {   
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('user/index.html.twig', [

            'users' => $users
        ]);
    }

     /**
     * @Route("/users/create", name="user_create")
     */
    public function create(Request $request,FlasherInterface $flasher): Response
    {  
        $user = new User();

        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $flasher->addSuccess('Vous avez créez un utilisateur avec succes');
            return $this->redirectToRoute('users');
        }
       
        return $this->render('user/create.html.twig', [

            'user_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/{id}", name="user_show")
     */
    public function show($id): Response
    {  
        $user = $this->getDoctrine()->getRepository(User::class)
        ->find($id);

        if (!$user) {
            
            throw $this->createNotFoundException("L'utilisateur recherché n'existe pas");
        }

        return $this->render('user/show.html.twig', [

            'user' => $user
        ]);
    }


    /**
     * @Route("/users/delete/{id}", name="user_delete")
     */
    public function delete($id, FlasherInterface $flasher): Response
    {   
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
        $flasher->addSuccess("L'utilisateur $id a bien été surprimé");
        return $this->redirectToRoute('users');
    }

    /**
     * @Route("/users/edit/{id<[0-9]+>}", name="user_edit")
     */
    public function edit(Request $request,$id, FlasherInterface $flasher): Response
    {  
        
        $user = new User();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $flasher->addSuccess("L'utilisateur a été modifié avec success");
            return $this->redirectToRoute('users');
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'user_form' => $form->createView(),
        ]);
    }
}
