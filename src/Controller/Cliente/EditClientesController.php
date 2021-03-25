<?php

namespace App\Controller\Cliente;

use App\Form\ClienteFormType;
use App\Model\Cliente\AddClientModel;
use App\Model\Cliente\DeleteClientModel;
use App\Model\Cliente\GetClientesModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditClientesController extends AbstractController
{
    private GetClientesModel $getClientesModel;
    private DeleteClientModel $deleteClient;
    private AddClientModel $addClientModel;

    private const Edit = 'editar';
    private const EditOK = 'Editado';
    private const EditERROR = 'Error al editar';

    private const Delete = 'eliminar';
    private const DeleteOK = 'Eliminado';
    private const DeleteERROR = 'Error al eliminar';

    public function __construct(GetClientesModel $getClientesModel, DeleteClientModel $deleteClient,
                                AddClientModel $addClientModel)
    {
        $this->getClientesModel = $getClientesModel;
        $this->deleteClient = $deleteClient;
        $this->addClientModel = $addClientModel;
    }

    /**
     * @Route("/editar", name="editar")
     * @param Request $request
     * @return Response
     */
    public function selectClient(Request $request): Response
    {
        if ($request->isMethod('POST')) {

            $nombre = $_POST['cliente'];
            $action = $_POST['action'];
            return $this->redirectToRoute("editarCliente", ['nombre' => $nombre, 'action' => $action]);
        }

        $nombres = $this->getClientesModel->getAllClientsNames();

        return $this->render('clientes/elegirEditar.html.twig', [
            'nombres' => $nombres,
        ]);
    }

    /**
     * @Route("/editar/{nombre}", name="editarCliente")
     * @param string $nombre
     * @param Request $request
     * @return Response
     */
    public function editClientSelected(String $nombre, Request $request): Response
    {
        $names = $this->getClientesModel->getAllClientsNames();
        $action = $_GET['action']??'';

        switch($action) {
            case self::Edit:
                $client = $this->getClientesModel->getClientByName($nombre);
                $form = $this->createForm(ClienteFormType::class, $client);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    $result = $this->addClientModel->addClient($client);

                    if ($result) {
                        $this->addFlash('success', self::EditOK);
                        return $this->redirectToRoute("editar");
                    } else {
                        $this->addFlash('error', self::EditERROR);
                        return $this->redirectToRoute("editar");
                    }
                }

                return $this->render('clientes/elegirEditar.html.twig', [
                    'editar' => true,
                    'nombres' => $names,
                    'client_form' => $form->createView(),
                ]);

            case self::Delete:

                return $this->render('clientes/elegirEditar.html.twig', [
                    'eliminar' => true,
                    'nombres' => $names,
                    'clientName' => $nombre
                ]);

            default:
                return $this->redirectToRoute('editar');
        }
    }

    /**
     * @Route("/delete/{clientName}", name="deleteClient")
     * @param string $clientName
     * @return Response
     */
    public function delete(string $clientName): Response {
        $client = $this->getClientesModel->getClientByName($clientName);
        $result = $this->deleteClient->deleteClient($client);

        if ($result) {
            $this->addFlash('success', self::DeleteOK);
            return $this->redirectToRoute('editar');
        } else {
            $this->addFlash('error', self::DeleteERROR);
            return $this->redirectToRoute("editar");
        }
    }
}
