<?php

namespace App\Controller\Admin;

use App\Entity\RoomImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RoomImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomImages::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('room')
                ->autocomplete()
                ->setFormTypeOptions(['multiple' => false]) ,
            // Field for the image file upload
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(), // Show this field only on forms

            // Field for displaying the uploaded image in the index and detail views
            ImageField::new('imageName')
                ->setBasePath('/uploads/rooms') // adjust this path as needed
                ->onlyOnIndex(), // Show this field only in the index

            // Include other fields as necessary
        ];
    }

}
