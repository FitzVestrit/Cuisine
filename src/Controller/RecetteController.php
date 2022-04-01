<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

class RecetteController extends AbstractController
{
    #[Route('/recette/liste', name: 'recette_liste')]
    public function index(
        RecetteRepository $recetteRepository
    ): Response
    {
        $recettes = $recetteRepository->findAll();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }



    #[Route('/recette/trifav', name: 'recette_trifav')]
    public function trifav(
        RecetteRepository $recetteRepository
    ): Response
    {
        $recettes = $recetteRepository->findfav();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }

    #[Route('/recette/trinom', name: 'recette_trinom')]
    public function trinom(
        RecetteRepository $recetteRepository
    ): Response
    {
        $recettes = $recetteRepository->findnom();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }

    #[Route('/recette/addfav/{id}', name: 'recette_addfav',requirements: ["id"=>"\d+"])]
    public function addfav(
        EntityManagerInterface $em,
        Request $request,
        RecetteRepository $recetteRepository,
        int $id
    ): Response
    {

        $recette = $recetteRepository->findOneById($id);
        $recetteForm =$this->createForm(RecetteType::class,$recette);
        $recetteForm->handleRequest($request);

            $recette->setIsfav(true);
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('recette_liste');

        $recettes = $recetteRepository->findAll();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }

    #[Route('/recette/delfav/{id}', name: 'recette_delfav',requirements: ["id"=>"\d+"])]
    public function delfav(
        EntityManagerInterface $em,
        Request $request,
        RecetteRepository $recetteRepository,
        int $id
    ): Response
    {

        $recette = $recetteRepository->findOneById($id);
        $recetteForm =$this->createForm(RecetteType::class,$recette);
        $recetteForm->handleRequest($request);

        $recette->setIsfav(false);
        $em->persist($recette);
        $em->flush();

        return $this->redirectToRoute('recette_liste');

        $recettes = $recetteRepository->findAll();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }

    #[Route('/recette/detail/{id}', name: 'recette_detail')]
    public function detail(
        RecetteRepository $recetteRepository,
        Recette $recette
    ): Response
    {
        return $this->render('recette/detail.html.twig',
            compact('recette')
        );
    }

    #[Route('/recette/test', name: 'recette_test')]
    public function test(
    ): Response
    {
        return $this->render('recette/test.html.twig'
        );
    }

    #[Route('/recette/del/{id}', name: 'recette_del',requirements: ["id"=>"\d+"])]
    public function del(
        EntityManagerInterface $em,
        Request $request,
        RecetteRepository $recetteRepository,
        int $id
    ): Response
    {
        $recette = $recetteRepository->findOneById($id);
        $recetteForm =$this->createForm(RecetteType::class,$recette);
        $recetteForm->handleRequest($request);

        $em->remove($recette);
        $em->flush();

        return $this->redirectToRoute('recette_liste');

        $recettes = $recetteRepository->findAll();
        return $this->render('recette/liste.html.twig',
            compact('recettes')
        );
    }


    #[Route('/recette/ajout', name: 'recette_ajout')]
    public function ajouter(
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
    $recette = new Recette();
    $recetteForm =$this->createForm(RecetteType::class,$recette);
    $recetteForm->handleRequest($request);

    if ($recetteForm->isSubmitted()) {
        $em->persist($recette);
        $em->flush();
        $this->addFlash(
            'bravo',
            'le recette a bien été ajouté'
        );
        return $this->redirectToRoute('recette_liste');
    }
        return $this->render('recette/ajout.html.twig',
            ['FormRecette' =>$recetteForm->createView()]
        );
    }

}
