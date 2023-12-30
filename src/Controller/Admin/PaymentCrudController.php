<?php

namespace App\Controller\Admin;

use App\Entity\Payment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaymentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Payment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Hide on form as it's auto-generated
            NumberField::new('amount'), // Changed to NumberField for numeric values
            // ->setFormTypeOption('attr', ['step' => '0.01']) // Uncomment to allow decimal values for amount

            DateTimeField::new('payment_date') // Ensures the admin user can pick a date and time
            ->setFormat('yyyy-MM-dd HH:mm:ss'), // Customize the date format as needed
            TextField::new('payment_method'),
            AssociationField::new('reservation')
                ->setCrudController(ReservationCrudController::class) // Link to the Reservation CRUD controller if needed
            // ->setQueryBuilderOptions(...) // Uncomment to customize the query for available reservations
        ];
    }
}
