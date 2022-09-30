<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $session = new Session();
        if (!$session->isStarted()) $session->start();
        $session->set("CvId", null);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
