<?php

namespace App\Controller;

use App\Entity\ElectrMeter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ElectrMeterFormType;
use App\Service\GeoService;
//Ajouter un compteur dépuis son compte
class AddElectrMeterController extends AbstractController
{
    private $geoService;
    
    public function __construct(GeoService $geoService)
    {
        
        $this->geoService = $geoService;
    }
    #[Route('/addElectrMeter', name: 'app_addElectrMeter')]
    public function addElectrMeter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $electrMeter = new ElectrMeter();
        $form = $this->createForm(ElectrMeterFormType::class, $electrMeter);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             // Associer l'utilisateur connecté
        $electrMeter->setUser($this->getUser());

        // Appel à l’API pour obtenir le code INSEE
        $inseeCode = $this->geoService->getInseeCode(
            $electrMeter->getCity(),
            $electrMeter->getPostalCode()
        );

        if ($inseeCode) {
            $electrMeter->setCodeInsee($inseeCode);
        }

        // Enregistrement en base
        $entityManager->persist($electrMeter);
        $entityManager->flush();

            return $this->redirectToRoute('app_studeffi');
            
        }

        return $this->render('electrmeter/addElectrMeter.html.twig', [
            'electrMeterForm' => $form->createView(),
        ]);
    }
}
