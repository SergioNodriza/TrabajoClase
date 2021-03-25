<?php


namespace App\Model\Cliente;


use App\Entity\Cliente;
use App\Repository\ClienteRepository;

class GetClientesModel
{

    private ClienteRepository $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function getAllClients(): array
    {
        return $this->clienteRepository->findAll();
    }

    public function getAllClientsNames(): array
    {
        $clientes = $this->clienteRepository->findAll();

        $nombres = [];
        foreach ($clientes as $cliente) {
            $nombres[] = $cliente->getNombre();
        }
        return $nombres;
    }

    public function getClientByName(string $nombre): ?Cliente
    {
        return $this->clienteRepository->findOneBy(['nombre' => $nombre]);
    }
}