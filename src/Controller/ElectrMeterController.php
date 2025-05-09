<?php

namespace App\Controller;

use App\Entity\ElectrMeter;
use App\Entity\User;
//use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ElectrMeterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class ElectrMeterController extends AbstractController
{
    #[Route('/', name: 'app_studeffi')]
    public function index(EntityManagerInterface $entityManagerInterface, Security $security): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();
        //Affichage de tous les compteurs d'électricité par ID d'utilisateur
        $electrMeterList = $entityManagerInterface->getRepository(ElectrMeter::class)->findBy(['user' => $user]);
        return $this->render('electrmeter/index.html.twig', [
            'electrMeterList' => $electrMeterList,
        ]);
    }

    //Affichage d'un compteur d'électricité
    #[Route(path:'electrMeter/{id}', name: 'showoneelectrmeter', requirements:['/electrMeter/id' => '\d+'])]
    public function showoneelectrmeter(ElectrMeter $electrMeter, ElectrMeterRepository $electrMeterRepository, $id)
    {
        $electrMeter = $electrMeterRepository->find($id);
        return $this->render('show/readOneElectrMeter.html.twig', [
            'electrMeter' => $electrMeter,
        ]);
    }
}
