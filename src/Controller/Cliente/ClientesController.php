<?php

namespace App\Controller\Cliente;


use App\Model\Cliente\GetClientesModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientesController extends AbstractController
{
    private GetClientesModel $getClientesModel;

    public function __construct(GetClientesModel $getClientesModel)
    {
        $this->getClientesModel = $getClientesModel;
    }

    /**
     * @Route("/clientes", name="clientes")
     */
    public function index(): Response
    {
        $clientes = $this->getClientesModel->getAllClients();

        return $this->render('clientes/clientes.html.twig', [
            'clientes' => $clientes,
        ]);
    }
}
