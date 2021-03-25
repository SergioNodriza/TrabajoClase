<?php

namespace App\Controller\Reserva;

use App\Model\Reserva\GetReservasModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListarReservasController extends AbstractController
{
    private GetReservasModel $getReservasModel;

    public function __construct(GetReservasModel $getReservasModel)
    {
        $this->getReservasModel = $getReservasModel;
    }

    /**
     * @Route("/reservas", name="reservas")
     */
    public function index(): Response
    {
        $reservas = $this->getReservasModel->getAllReservas();

        return $this->render('reservas/reservas.html.twig', [
            'reservas' => $reservas,
        ]);
    }
}
