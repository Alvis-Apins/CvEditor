<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvJobExperience;
use App\Form\WorkExperienceFormType;
use App\Repository\CvJobExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvWorkExperienceEditController extends AbstractController
{
    #[Route('/cv-work-experience', name: 'app_cv_work_experience_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $jobExperience = new CvJobExperience();
        $session = $request->getSession();

        if ($session->get("Edit-Work") != null) {
            $workExperienceRepository = new CvJobExperienceRepository($doctrine);
            $jobExperience = $workExperienceRepository->find($session->get("Edit-Work"));
        }

        $form = $this->createForm(WorkExperienceFormType::class, $jobExperience);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $jobExperience->setCv($cv);
            $entityManager->persist($jobExperience);
            $entityManager->flush();

            $session->set("JobId", $jobExperience->getId());
            $session->remove("Edit-Work");

            return $this->redirectToRoute('app_cv_work_experience_skill_edit');
        }
        return $this->render('cv_work_experience_edit/index.html.twig', [
            'job_experience' => $jobExperience,
            'job_experience_form' => $form->createView()
        ]);
    }
}
