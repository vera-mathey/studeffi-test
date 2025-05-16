<?php

namespace App\Controller;

use App\Entity\ElectrMeter;
use App\Entity\User;
use App\Entity\Reading;
//use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ElectrMeterRepository;
use App\Repository\ReadingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Form\readingFormType;
use Doctrine\ORM\EntityManager;

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
    #[Route(path:'electrMeter/{id}', name: 'showoneelectrmeter', requirements:['id' => '\d+'])]
    public function showoneelectrmeter(ElectrMeter $electrMeter, ElectrMeterRepository $electrMeterRepository, ReadingRepository $readingRepository, EntityManagerInterface $entityManager, Request $request, )
    {
        //$electrMeter = $electrMeterRepository->find($id);
        //$readings = $readingRepository->findByElectrMeter($id);

        //add reading
        $reading = new Reading();
        $reading->setElectrMeter($electrMeter);

        $form = $this->createForm(ReadingFormType::class, $reading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reading);
            $entityManager->flush();
            return $this->redirectToRoute('showoneelectrmeter', ['id' => $electrMeter->getId()]);
        }

        return $this->render('show/readOneElectrMeter.html.twig', [
            'electrMeter' => $electrMeter,
            'readingForm' => $form->createView(),
            'readings' => $electrMeter->getReadings(),
        ]);    
    }
    #[Route('/reading/{id}/edit', name: 'edit_reading', methods: ['GET', 'POST'])]
    public function editReading(Request $request, EntityManager $entityManager, Reading $reading): Response
    {
        $form = $this->createForm(ReadingFormType::class, $reading);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }
        return $this->render('reading/_edit_form.html.twig', [
            'form' => $form->createView(),
            'reading' => $reading,
        ]);
    }
}