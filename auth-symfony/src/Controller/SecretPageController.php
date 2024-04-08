<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecretPageController extends AbstractController
{
    #[Route('/secret/page', name: 'app_secret_page')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('secret_page/index.html.twig', [
            'controller_name' => 'SecretPageController',
        ]);
    }
}
