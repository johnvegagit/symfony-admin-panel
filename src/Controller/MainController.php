<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', 'home')]
    public function index(): Response
    {
        $title = 'Welcome to symfony admin panel';

        return $this->render('/main/homepage.html.twig', [
            'title' => $title
        ]);
    }

    #[Route('/customer', 'customer')]
    public function customers(): Response
    {
        $title = 'Customers page';

        return $this->render('/customer/customer.html.twig', [
            'title' => $title
        ]);
    }

    #[Route('/order', 'order')]
    public function orders(): Response
    {
        $title = 'Orders page';

        return $this->render('/order/order.html.twig', [
            'title' => $title
        ]);
    }
}