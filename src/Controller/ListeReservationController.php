<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[IsGranted("ROLE_ADMIN")]
#[Route("/admin")]
class ListeReservationController extends AbstractController
{
    #[Route('/liste/reservation', name: 'app_liste_reservation')]
    public function index(): Response
    {
        return $this->render('liste_reservation/index.html.twig');
    }

    #[Route('/historiquereser', name: 'app_historiquereser')]
    public function historique(): Response
    {
        return $this->render('liste_reservation/historique.html.twig');
    }
}
