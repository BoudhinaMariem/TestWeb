<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Arbre;
use App\Repository\ParcRepository;
use App\Repository\ArbreRepository;
use App\Form\ArbreType;

class ArbreController extends AbstractController
{
    #[Route('/arbre', name: 'app_arbre')]
    public function index(): Response
    {
        return $this->render('arbre/index.html.twig', [
            'controller_name' => 'ArbreController',
        ]);
    }

    #[Route('/arbre/add', name: 'add_arbre')]
    public function add(Request $request): Response
    {
        $arbre = new Arbre();
        $form = $this->createForm(ArbreType::class, $arbre);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            $manager->getManager()->persist($arbre);
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_listarbre');
        }
        return $this->render('arbre/add.html.twig',['f'=>$form->createView()]);
    }

    #[Route('/arbre/list', name:'app_listarbre')]
    public function list(ArbreRepository $repo){
        $arbre = $repo->findAll();
        return $this->render('arbre/list.html.twig', ['arbres' => $arbre]);
    }
    

}
