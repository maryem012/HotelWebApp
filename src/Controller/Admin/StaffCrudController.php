<?php

namespace App\Controller\Admin;

use App\Entity\Staff;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StaffCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Staff::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
        TextField::new('name'),
        TextField::new('role'),
        TextField::new('email'),

        TextField::new('phone'),
            AssociationField::new('hotel')
                ->setFormTypeOptions([
                    'choice_label' => 'name', // Use 'name' property as the label for the dropdown options
                ]),// You can add options like autocomplete to enhance the field
    ];

    }
}
