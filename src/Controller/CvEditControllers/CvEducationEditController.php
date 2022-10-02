<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvEducation;
use App\Form\EducationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvEducationEditController extends AbstractController
{
    #[Route('/cv-education', name: 'app_cv_education_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $education = new CvEducation();
        $session = new Session();
        $form = $this->createForm(EducationFormType::class, $education);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $education->setCv($cv);
            $entityManager->persist($education);
            $entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('cv_education_edit/index.html.twig', [
            'education_form' => $form->createView()
        ]);
    }
}
