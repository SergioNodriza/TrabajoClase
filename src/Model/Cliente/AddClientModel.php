<?php


namespace App\Model\Cliente;


use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AddClientModel
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addClient(Cliente $cliente): bool
    {
        try {

            $this->entityManager->persist($cliente);
            $this->entityManager->flush();
            return true;

        } catch (Exception$exception) {
            return false;
        }
    }
}