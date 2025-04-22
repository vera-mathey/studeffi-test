<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('email'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            $roles = ChoiceField::new('roles')->setColumns('col-md-6')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_EDITOR' => 'ROLE_EDITOR',
                'ROLE_MODO' => 'ROLE_MODO',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
            ])->allowMultipleChoices(),
            TextEditorField::new('description')->setColumns('col-md-12|raw|nl2br'),
            BooleanField::new('roleadmin')->setColumns('col-md-2'),
        ];
    }
    
}
