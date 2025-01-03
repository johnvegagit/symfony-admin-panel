<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', 'app_homepage_index')]
    public function index(): Response
    {
        $title = 'Welcome to symfony admin panel';

        return $this->render('/main/homepage.html.twig', [
            'title' => $title
        ]);
    }

}