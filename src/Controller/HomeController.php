<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Fetch rooms along with associated images using a join query
        $rooms = $this->entityManager->getRepository(Room::class)
            ->createQueryBuilder('r')
            ->leftJoin('r.images', 'ri')
            ->addSelect('ri')
            ->getQuery()
            ->getResult();

        $hotels = $this->entityManager->getRepository(Hotel::class)
            ->createQueryBuilder('h')
            ->leftJoin('h.HotelImages', 'hi')
            ->addSelect('hi')
            ->getQuery()
            ->getResult();
        return $this->render('home/index.html.twig', [
            'rooms' => $rooms,
            'hotels' => $hotels,


        ]);
    }
}
