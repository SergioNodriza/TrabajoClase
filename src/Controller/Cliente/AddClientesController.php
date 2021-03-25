<?php

namespace App\Controller\Cliente;

use App\Entity\Cliente;
use App\Form\ClienteFormType;
use App\Model\Cliente\AddClientModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddClientesController extends AbstractController
{
    private AddClientModel $addClientModel;

    private const OK = 'Insertado';
    private const ERROR = 'Error al Insertar';

    public function __construct(AddClientModel $addClientModel)
    {
        $this->addClientModel = $addClientModel;
    }

    /**
     * @Route("/añadir", name="añadir")
     * @param Request $request
     * @return Response
     */
    public function addClients(Request $request): Response
    {
        $client = new Cliente();
        $form = $this->createForm(ClienteFormType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $result = $this->addClientModel->addClient($client);

            if ($result) {
                $this->addFlash('success', self::OK);
                return $this->redirectToRoute('añadir');
            } else {
                $this->addFlash('error', self::ERROR);
                return $this->redirectToRoute("añadir");
            }
        }

        return $this->render('clientes/añadir.html.twig', [
            'client_form' => $form->createView(),
        ]);
    }
}
