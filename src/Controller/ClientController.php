<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Client;

final class ClientController extends AbstractController
{

    #[Route('/client', name: 'app_client')]
    public function index(ClientRepository $clientRepository, Request $request): Response
    {
        $page = $request->query->get('page', 1);
        $data = $clientRepository->getAllPaginated($page, 10);

        return $this->render('client/index.html.twig', compact('data'));

    }


    #[Route('/client/create', name: 'app_client_create')]
    public function create(): Response
    {
        // Logic to create a new client would go here
        return $this->render('client/create.html.twig');
    }


    #[Route('client/add', name: 'app_client_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (empty($request->get('companyName')) || empty($request->get('companyName')) || empty($request->get('email')) || empty($request->get('phone')) || $request->getMethod() !== 'POST') {
            $this->addFlash('error', 'Please fill in all fields.');
            return $this->redirectToRoute('app_client_create');
        }

        $client = new Client();
        $client->setCompanyName($request->get('companyName'));
        $client->setContactName($request->get('contactName'));
        $client->setEmail($request->get('email'));
        $client->setPhone($request->get('phone'));

        $entityManager->persist($client);
        $entityManager->flush();

        return $this->redirectToRoute('app_client');

    }

    #[Route('client/update/{id}', name: 'app_client_update')]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {

        $client = $entityManager->getRepository(Client::class)->find($id);
        if (!$client) {
            throw $this->createNotFoundException(
                'No client found for id '.$id
            );
        }

        $client->setCompanyName($request->get('companyName'));
        $client->setContactName($request->get('contactName'));
        $client->setEmail($request->get('email'));
        $client->setPhone($request->get('phone'));

        //$entityManager->persist($client);
        $entityManager->flush();

        return $this->redirectToRoute('app_client');
    }


    #[Route('/client/edit/{id}', name: 'app_client_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id, ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->find($id);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }
        // Logic to edit the client would go here
        return $this->render('client/edit.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('client/search', name: 'app_client_search', methods: ['GET'])]
    public function search(Request $request, ClientRepository $clientRepository): Response
    {
        $companyName = $request->query->get('search');
        //dd($companyName);
        $page = $request->query->get('page', 1);
        $data = $clientRepository->searchByCompanyNamePaginated($companyName, $page, 10);
        //dd($data);
        return $this->render('client/index.html.twig', compact('data', 'companyName'));

    }

    #[Route('/client/delete/{id}', name: 'app_client_delete', requirements: ['id' => '\d+'])]
    public function delete(int $id, ClientRepository $clientRepository, EntityManagerInterface $entityManager): Response
    {
        $client = $clientRepository->find($id);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }

        $entityManager->remove($client);
        $entityManager->flush();

        return $this->redirectToRoute('app_client');
    }

    #[Route('/client/{id}', name: 'app_client_show', requirements: ['id' => '\d+'])]
    public function show(int $id, ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->find($id);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }
    #[Route('/client/{id}/invoices', name: 'app_client_show_invoices', requirements: ['id' => '\d+'])]
    public function showWithInvoices(int $id, ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->find($id);
        //dd($client);
        if (!$client) {
            throw $this->createNotFoundException('Client not found');
        }
        $invoices = $client->getInvoices();
        //dd($invoices);
        return $this->render('client/show_with_invoices.html.twig', [
            'client' => $client,
            'invoices' => $invoices,
        ]);
    }

}
