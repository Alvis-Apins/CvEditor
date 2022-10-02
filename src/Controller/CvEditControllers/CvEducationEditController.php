<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvEducation;
use App\Form\EducationFormType;
use App\Repository\CvEducationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvEducationEditController extends AbstractController
{
    #[Route('/cv-education', name: 'app_cv_education_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $education = new CvEducation();
        $session = $request->getSession();

        if ($session->get("Edit-Education") != null) {
            $educationRepository = new CvEducationRepository($doctrine);
            $education = $educationRepository->find($session->get("Edit-Education"));
        }

        $form = $this->createForm(EducationFormType::class, $education);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $education->setCv($cv);
            $entityManager->persist($education);
            $entityManager->flush();
            $session->remove("Edit-Education");

            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('cv_education_edit/index.html.twig', [
            'education' => $education,
            'education_form' => $form->createView()
        ]);
    }
}
