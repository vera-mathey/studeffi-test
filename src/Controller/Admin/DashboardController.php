<?php

namespace App\Controller\Admin;

use App\Entity\ElectrMeter;
use App\Entity\User;
use App\Entity\Reading;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Repository\UserRepository;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
//Declarer la variable $userRepository en protected
    protected $userRepository;
    //Mettre en place le constructor
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if($this->isGranted('ROLE_EDITOR')) {
            return $this->render('admin/dashboard.html.twig');
        }else
            return $this->redirectToRoute('app_studeffi');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Studeffi');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Aller au site', 'fa-solid fa-arrow-rotate-left', 'app_studeffi');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToDashboard('Tableau de bord', 'fa-solid fa-table-columns')
            ->setPermission('ROLE_ADMIN');
        }
        if($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section("Compteurs d'électricité");
            yield MenuItem::subMenu("Compteurs d'électricité", 'fas fa-newspaper')
            ->setSubItems([
                MenuItem::LinkToCrud("Créer un compteur d'électricité", 'fa-regular fa-square-plus', ElectrMeter::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud("Voir les compteurs d'électricité", 'fas fa-eye', ElectrMeter::class)
            ]);
        }
        if($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section("Relevé");
            yield MenuItem::subMenu("Releves", 'fas fa-newspaper')
            ->setSubItems([
                MenuItem::LinkToCrud("Créer un relevé", 'fa-regular fa-square-plus', Reading::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud("Voir les relevés", 'fas fa-eye', Reading::class)
            ]);
        }
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Utilisateur');
            yield MenuItem::subMenu('Utilisateur','fa-solid fa-user')
            ->setSubItems([
                MenuItem::linkToCrud('Créer un utilisateur','fa-regular fa-square-plus', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir utilisateurs','fas fa-eye', User::class),
            ]);
        }
        if($this->isGranted('ROLE_SUPER_ADMIN')){
            yield MenuItem::section('Utilisateurs');
            yield MenuItem::subMenu('Utilisateurs','fa-solid fa-user')
            ->setSubItems([
                MenuItem::linkToCrud('Créer un utilisateur','fa-regular fa-square-plus', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir uilisateurs','fas fa-eye', User::class),
            ]);
        }
    }
}
