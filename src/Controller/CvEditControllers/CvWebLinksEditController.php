<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvWebLinks;
use App\Form\WebLinkFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvWebLinksEditController extends AbstractController
{
    #[Route('/cv-web-link', name: 'app_cv_web_links_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $webLink = new CvWebLinks();
        $session = new Session();
        $form = $this->createForm(WebLinkFormType::class, $webLink);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $webLink->setCv($cv);
            $entityManager->persist($webLink);
            $entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('cv_web_links_edit/index.html.twig', [
            'web_link_form' => $form->createView()
        ]);
    }
}
