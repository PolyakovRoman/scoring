<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Client\Entity\Client;
use App\Scoring\ScoringService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Client\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;

final class ClientController extends AbstractController
{
    #[Route('/client/registration', name: 'client_registration')]
    public function registration(Request $request, EntityManagerInterface $em, ScoringService $scoringService): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $score = $scoringService->calc($client);
            $client->setScore($score);
            $em->persist($client);
            $em->flush();
            $this->addFlash('success-registration', 'Регистрация успешно завершена');
            return $this->redirectToRoute('client_registration');
        }

        return $this->render('client/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/client', name: 'app_client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
