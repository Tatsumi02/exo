<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Entity\Ressources;
use App\Repository\SallesRepository;
use App\Entity\Salles;
use App\Repository\AdminRepository;
use App\Repository\RessourcesRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted("ROLE_ADMIN")]
#[Route("/admin")]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/adduser', name: 'add_user')]
    public function ajouterutilisateur(): Response
    {
        return $this->render('admin/ajouterutilisateur.html.twig');
    }

    #[Route('/viewlist_salles', name: 'app_add_salles')]
    public function viewlist(SallesRepository $salleRepository): Response
    {
        return $this->render('admin/viewlist_salles.html.twig', [
            'salles' => $salleRepository->findAll()
        ]);
    }

    #[Route('/add_salles', name: 'add_salles')]
    public function add_salles(): Response
    {
        return $this->render('admin/add_salles.html.twig');
    }


    #[Route('/save_salles', name: 'save_salles')]
    public function save_salles(SallesRepository $salleRepository, UserRepository $userRepository, Request $request): Response
    {
        $datas = $request->request->all();
        // $admin = $userRepository->findOneBy(['posseseur' => $this->getUser()]);

        $salle = new Salles();
        $salle->setPosseseur($this->getUser());
        $salle->setNom($datas['nom']);
        $salle->setLocalisation($datas['localisation']);

        $salleRepository->add($salle);

        $this->addFlash('succ', 'Operation bien effectuer');

        return $this->redirectToRoute('app_add_salles');
    }


    // partir ressource

    #[Route('/listeressouce', name: 'app_listressource')]
    public function viewlistRessource(RessourcesRepository $ressourceRepository): Response
    {

        return $this->render('admin/listeressouce.html.twig', [
            'ressources' => $ressourceRepository->findAll()
        ]);
    }

    #[Route('/addressource', name: 'app_add')]
    public function ressource(): Response
    {
        return $this->render('admin/add_ressource.html.twig');
    }



    #[Route('/save_ressources', name: 'save_ressources')]
    public function save_ressource(RessourcesRepository $ressourceRepository, Request $request): Response
    {
        $datas = $request->request->all();
        //  $admin = $adminRepository->findOneBy(['posseseur' => $this->getUser()]);


        $ressource = new Ressources();
        // $ressource->setAdmin($this->getUser());
        $ressource->setTypesressource($datas['types']);
        $ressource->setNom($datas['nom']);
        $ressource->setQuantite($datas['quantite']);
        $ressource->setDescription($datas['description']);
        $ressource->setDatecreation(new \DateTimeImmutable());

        $ressourceRepository->add($ressource);

        $this->addFlash('succ', 'Operation bien effectuer');

        return $this->redirectToRoute('app_listressource');
    }
}
