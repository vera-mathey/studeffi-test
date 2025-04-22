<?php

namespace App\Controller\Admin;

use App\Entity\ElectrMeter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GeoService;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

class ElectrMeterCrudController extends AbstractCrudController
{
    
    private $geoService;
    public function __construct(GeoService $geoService)
    {
        
        $this->geoService = $geoService;
    }
    public static function getEntityFqcn(): string
    {
        return ElectrMeter::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural("Compteurs d'électricité")
        ->setEntityLabelInSingular("Compteur d'électricité")
        ->setPageTitle("index", "Studeffi - Compteurs d'électricité")
        ->setEntityLabelInSingular("Compteur d'électricité")
        ->setPaginatorPageSize(10);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex(),
            TextField::new('owner'),
            TextField::new('streetNumber'),
            TextField::new('streetName'),
            TextField::new('postalCode'),
            TextField::new('city'),
            TextField::new('codeInsee')->setFormType(TextType::class)->setFormTypeOption('disabled', true), // Champ INSEE, non modifiable
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof ElectrMeter) {
        return;
    }

    // Appel à l'API pour chercher le code INSEE
    $inseeCode = $this->geoService->getInseeCode(
        $entityInstance->getCity(),
        $entityInstance->getPostalCode()
    );

    if ($inseeCode) {
        $entityInstance->setCodeInsee($inseeCode);
    }

    $entityManager->persist($entityInstance);
    $entityManager->flush();
}
    
}
