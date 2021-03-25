<?php


namespace App\Controller\Reserva;


use App\Model\Cliente\GetClientesModel;
use App\Model\Reserva\AddReservaModel;
use App\Model\Vuelo\GetVuelosModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddReservasController extends AbstractController
{

    private GetClientesModel $getClientesModel;
    private GetVuelosModel $getVuelosModel;
    private AddReservaModel $addReservaModel;

    private const OK = 'Insertada';
    private const ERROR = 'Error al Insertar';

    public function __construct(GetClientesModel $getClientesModel, GetVuelosModel $getVuelosModel,
                                AddReservaModel $addReservaModel)
    {
        $this->getClientesModel = $getClientesModel;
        $this->getVuelosModel = $getVuelosModel;
        $this->addReservaModel = $addReservaModel;
    }

    /**
     * @Route("/añadirReservas", name="add_reservas")
     * @param Request $request
     * @return Response
     */
    public function addClients(Request $request): Response
    {
        if ($request->isMethod('post')) {

            $result = $this->addReservaModel->addReserva($_POST['cliente'], $_POST['vuelo']);

            if ($result) {
                $this->addFlash('success', self::OK);
                return $this->redirectToRoute('reservas');
            } else {
                $this->addFlash('error', self::ERROR);
                return $this->redirectToRoute("add_reservas");
            }
        }

        $clientes = $this->getClientesModel->getAllClients();
        $vuelos = $this->getVuelosModel->getVuelosByDate();

        return $this->render('reservas/add_reservas.html.twig', [
            'clientes' => $clientes,
            'vuelos' => $vuelos
        ]);
    }
}