<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ViewCvController extends AbstractController
{
    #[Route('/view-cv', name: 'app_view_cv')]
    public function index(): Response
    {
        $session = new Session();
        //dd($session->get("CvId"));

        return $this->render('view_cv/index.html.twig', [
            'controller_name' => 'ViewCvController',
        ]);
    }
}
