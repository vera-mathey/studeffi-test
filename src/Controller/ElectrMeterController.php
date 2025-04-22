<?php

namespace App\Controller;

use App\Entity\ElectrMeter;
//use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ElectrMeterRepository;
use Doctrine\ORM\EntityManagerInterface;

class ElectrMeterController extends AbstractController
{
    #[Route('/', name: 'app_studeffi')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        //Affichage de tous les compteurs d'électricité
        $electrMeterList = $entityManagerInterface->getRepository(ElectrMeter::class)->findAll();
        return $this->render('electrmeter/index.html.twig', [
            'electrMeterList' => $electrMeterList,
        ]);
    }

    //Affichage d'un compteur d'électricité
    #[Route(path:'electrMeter/{id}', name: 'showoneelectrmeter', requirements:['/electrmeter/id' => '\d+'])]
    public function showoneelectrmeter(ElectrMeter $electrmeter, ElectrMeterRepository $electrMeterRepository, $id)
    {
        $electrmeter = $electrMeterRepository->find($id);
        return $this->render('show/readOneElectrMeter.html.twig', [
            'electrmeter' => $electrmeter,
        ]);
    }
}
