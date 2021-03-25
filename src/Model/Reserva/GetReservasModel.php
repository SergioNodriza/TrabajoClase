<?php


namespace App\Model\Reserva;


use App\Repository\ReservaRepository;

class GetReservasModel
{
    private ReservaRepository $reservaRepository;

    public function __construct(ReservaRepository $reservaRepository)
    {
        $this->reservaRepository = $reservaRepository;
    }

    public function getAllReservas(): array
    {
        return $this->reservaRepository->findAll();
    }
}