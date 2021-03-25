<?php


namespace App\Model\Reserva;


use App\Entity\Reserva;
use App\Repository\ClienteRepository;
use App\Repository\VueloRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class AddReservaModel
{
    private EntityManagerInterface $entityManager;
    private ClienteRepository $clienteRepository;
    private VueloRepository $vueloRepository;

    public function __construct(EntityManagerInterface $entityManager,
                                ClienteRepository $clienteRepository,
                                VueloRepository $vueloRepository)
    {
        $this->entityManager = $entityManager;
        $this->clienteRepository = $clienteRepository;
        $this->vueloRepository = $vueloRepository;
    }

    public function addReserva($clientId, $vueloId)
    {
        try {
            $reserva = new Reserva();

            $cliente = $this->clienteRepository->findOneBy(['id' => $clientId]);
            $vuelo = $this->vueloRepository->findOneBy(['id' => $vueloId]);

            $reserva->setCliente($cliente);
            $reserva->setVuelo($vuelo);
            $reserva->setFecha(new DateTime());

            $this->entityManager->persist($reserva);
            $this->entityManager->flush();
            return true;

        } catch (\Exception $exception) {
            return false;
        }
    }
}