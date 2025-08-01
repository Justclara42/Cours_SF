<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\InvoiceStatus;
use App\Repository\InvoiceStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InvoiceStatusController extends AbstractController
{
    #[Route('/invoice/status', name: 'app_invoice_status')]
    public function index(InvoiceStatusRepository $invoiceStatus): Response
    {
        $status = $invoiceStatus->findAll();
        return $this->render('invoice_status/index.html.twig', [
            'status' => $status,
        ]);
    }
    #[Route('/invoice/status/create', name: 'app_invoice_status_create')]
    public function create(): Response
    {
        // Logic to create a new invoice status would go here
        return $this->render('invoice_status/create.html.twig');
    }
    #[Route('/invoice/status/add', name: 'app_invoice_status_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (empty($request->get('name'))|| $request->getMethod() !== 'POST') {
            $this->addFlash('error', 'Please fill in all fields.');
            return $this->redirectToRoute('app_invoice_status_create');
        }

        $status = new InvoiceStatus();
        $status->setName($request->get('name'));

        $entityManager->persist($status);
        $entityManager->flush();

        return $this->redirectToRoute('app_invoice_status');

    }
}
