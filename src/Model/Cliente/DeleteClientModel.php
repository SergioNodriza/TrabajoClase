<?php


namespace App\Model\Cliente;


use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;

class DeleteClientModel
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function deleteClient(Cliente $cliente): bool
    {
        try {

            $this->entityManager->remove($cliente);
            $this->entityManager->flush();
            return true;

        } catch (Exception$exception) {
            return false;
        }
    }
}