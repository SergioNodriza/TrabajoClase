<?php

namespace App\Controller\Vuelo;

use App\Model\Vuelo\GetVuelosModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListarVuelosController extends AbstractController
{

    private GetVuelosModel $getVuelosModel;

    public function __construct(GetVuelosModel $getVuelosModel)
    {

        $this->getVuelosModel = $getVuelosModel;
    }

    /**
     * @Route("/vuelos", name="listar_vuelos")
     */
    public function index(): Response
    {
        $vuelos = $this->getVuelosModel->getVuelosByDate();
        return $this->render('listar_vuelos/vuelos.html.twig', [
            'vuelos' => $vuelos,
        ]);
    }
}
