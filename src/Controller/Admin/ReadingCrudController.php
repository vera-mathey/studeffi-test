<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use App\Entity\Reading;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ReadingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reading::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural("Relevés")
        ->setEntityLabelInSingular("Relevé")
        ->setPageTitle("index", "Studeffi - Relevés")
        ->setEntityLabelInSingular("Relevé")
        ->setPaginatorPageSize(10);
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex(),
            TextField::new('value'),
            DateField::new('date'),
            AssociationField::new('electrMeter')->setColumns('col-md-3'),
        ];
    }
}
