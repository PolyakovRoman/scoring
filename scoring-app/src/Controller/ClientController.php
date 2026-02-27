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
use App\Client\Repository\ClientRepository;
use Knp\Component\Pager\PaginatorInterface;

final class ClientController extends AbstractController
{
    /**
     * Регистрация клиента
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ScoringService $scoringService
     * @return Response
     */
    #[Route('/client/registration', name: 'client_registration')]
    public function registration(
        Request $request,
        EntityManagerInterface $em,
        ScoringService $scoringService
    ): Response
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

    /**
     * Страница просмотра клиента
     *
     * @param Client $client
     * @return Response
     */
    #[Route('/client/{id}', name: 'client_show')]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * Страница редактирования клиента
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ScoringService $scoringService
     * @param Client $client
     * @return Response
     */
    #[Route('/client/{id}/edit', name: 'client_edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        ScoringService $scoringService,
        Client $client
    ): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $score = $scoringService->calc($client);
            $client->setScore($score);
            $em->flush();
            $this->addFlash('success-edit', 'Пользователь успешно обновлен');
            return $this->redirectToRoute('client_edit', ['id' => $client->getId()]);
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
        ]);
    }

    /**
     * Список клиентов
     *
     * @param ClientRepository $clientRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/clients', name: 'client_list')]
    public function index(
        ClientRepository $clientRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $query = $clientRepository->createListQuery();
        $clients = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            15
        );
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }
}
