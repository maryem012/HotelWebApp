<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use App\Entity\RoomImages;
use App\RoomTypes;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('chamberNumber'), // Add this line for the chamber number field
            ChoiceField::new('room_type')->setChoices([
                'Single Room' => RoomTypes::SINGLE,
                'Double Room' => RoomTypes::DOUBLE,
                'Deluxe Room' => RoomTypes::DELUXE,
                ' Premium Suite' => RoomTypes::SUITE,
                'Premium Room' => RoomTypes::PREMIUM,
                'Luxury Room' => RoomTypes::LUXURY,

            ]),
            MoneyField::new('price')->setCurrency('USD'), // Change 'USD' to your desired currency code
            BooleanField::new('availability'),

            TextField::new('amenities'),
            AssociationField::new('hotel')
                ->setFormTypeOptions([
                    'choice_label' => 'name', // Use 'name' property as the label for the dropdown options
                ]),




        ];
    }
}