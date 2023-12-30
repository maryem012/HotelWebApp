<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class ReservationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($pageName === 'new') {
            return [
                IdField::new('id')->hideOnForm(),
                AssociationField::new('guest', 'Guest'),
                AssociationField::new('rooms')
                    ->autocomplete()
                    ->setFormTypeOptions(['multiple' => true]) // Allow selecting multiple rooms
                    ->setQueryBuilder(function ($queryBuilder) {
                        return $queryBuilder
                            ->andWhere('entity.availability = :available')
                            ->setParameter('available', true);
                    }),
                DateTimeField::new('checkInDate'),
                DateTimeField::new('checkOutDate'),
                MoneyField::new('totalPrice')
                    ->setCurrency('USD'),
                ChoiceField::new('status')->setChoices([
                    'Pending' => 'pending',
                    'Confirmed' => 'confirmed',
                    'Cancelled' => 'cancelled',
                ]),
            ];
        }

        return parent::configureFields($pageName);
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Reservation) {
            $entityInstance->setTotalPrice($entityInstance->calculateTotalAmount());
        }
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Reservation) {
            $entityInstance->setTotalPrice($entityInstance->calculateTotalAmount());
        }
        parent::updateEntity($entityManager, $entityInstance);
    }
}
