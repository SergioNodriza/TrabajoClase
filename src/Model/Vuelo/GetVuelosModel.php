<?php

namespace App\Model\Vuelo;

use App\Repository\VueloRepository;
use DateTime;

class GetVuelosModel
{
    private $vueloRepository;

    public function __construct(VueloRepository $vueloRepository)
    {
        $this->vueloRepository = $vueloRepository;
    }

    public function getVuelosByDate(): array
    {
        $allVuelos = $this->vueloRepository->findAll();

        $vuelos = [];
        foreach ($allVuelos as $vuelo) {
            if ($vuelo->getFechaSalida() > new DateTime()) {
                $vuelos[] = $vuelo;
            }
        }
        return $vuelos;
    }
}