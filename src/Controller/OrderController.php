<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/order')]
final class OrderController extends AbstractController
{
    #[Route(name: 'app_order_index', methods: ['GET'])]
    public function index(Request $request, OrderRepository $orderRepository, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('search', null);

        if ($searchTerm) {
            // Busca productos con el término de búsqueda
            $queryBuilder = $orderRepository->createQueryBuilder('c')
                ->where('c.product_name LIKE :search')
                ->setParameter('search', '%' . $searchTerm . '%');
        } else {
            // Obtén todos los productos
            $queryBuilder = $orderRepository->createQueryBuilder('c');
        }

        // Paginar los resultados
        $pagination = $paginator->paginate(
            $queryBuilder, // Consulta o QueryBuilder
            $request->query->getInt('page', 1), // Página actual, por defecto 1
            5 // Número de resultados por página
        );

        return $this->render('order/index.html.twig', [
            'pagination' => $pagination,
            'search' => $searchTerm,
        ]);
    }

    #[Route('/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            $this->addFlash(
                'error',
                'Error adding new product!'
            );

            return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were updated!'
            );

            $this->addFlash(
                'error',
                'Error updated order!'
            );

            return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $order->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
