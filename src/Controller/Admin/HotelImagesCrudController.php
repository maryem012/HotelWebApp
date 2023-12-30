<?php

namespace App\Controller\Admin;

use App\Entity\HotelImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HotelImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HotelImages::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('hotel')
                ->autocomplete()
                ->setFormTypeOptions(['multiple' => false]) ,
            // Field for the image file upload
            Field::new('hotelImageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(), // Show this field only on forms

            // Field for displaying the uploaded image in the index and detail views
            ImageField::new('hotelImagePath')
                ->setBasePath('/uploads/hotel') // adjust this path as needed
                ->onlyOnIndex(), // Show this field only in the index

            // Include other fields as necessary
        ];
    }

}
