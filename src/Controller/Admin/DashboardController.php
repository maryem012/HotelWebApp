<?php

namespace App\Controller\Admin;

use App\Entity\Guest;
use App\Entity\Hotel;
use App\Entity\HotelImages;
use App\Entity\Payment;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\RoomImages;
use App\Entity\Staff;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'adminPanel')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Skyline Agency');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Hotels Management', 'fa fa-question-circle', Hotel::class);
        yield MenuItem::linkToCrud('Rooms Management', 'fa fa-question-circle', Room::class);
        yield MenuItem::linkToCrud('Staff Management', 'fa fa-question-circle', Staff::class);
        yield MenuItem::linkToCrud('Reservations Management', 'fa fa-question-circle', Reservation::class);
        yield MenuItem::linkToCrud('Guests Management', 'fa fa-question-circle', Guest::class);
        yield MenuItem::linkToCrud('payment Management', 'fa fa-question-circle', Payment::class);
        yield MenuItem::linkToCrud('room images ', 'fa fa-question-circle', roomImages::class);
        yield MenuItem::linkToCrud('hotel images ', 'fa fa-question-circle', HotelImages::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
