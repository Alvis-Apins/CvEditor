<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvJobExperience;
use App\Entity\CvJobExperienceSkills;
use App\Form\WorkExperienceFormType;
use App\Form\WorkExperienceSkillsFormType;
use App\Repository\CvJobExperienceRepository;
use App\Repository\CvJobExperienceSkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvWorkExperienceSkillEditController extends AbstractController
{

    private CvJobExperienceSkillsRepository $cvJobExperienceSkillsRepository;

    public function __construct(CvJobExperienceSkillsRepository $cvJobExperienceSkillsRepository)
    {

        $this->cvJobExperienceSkillsRepository = $cvJobExperienceSkillsRepository;
    }

    #[Route('/cv-experience-skill', name: 'app_cv_work_experience_skill_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $jobSkill = new CvJobExperienceSkills();
        $session = $request->getSession();
        //dd($session->get("JobId"));
        $job = $session->get("JobId");
        $skills = $this->cvJobExperienceSkillsRepository->findBy(["job" => $job]);
        //dd($skills);

        $form = $this->createForm(WorkExperienceSkillsFormType::class, $jobSkill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!isset($request->request->all("work_experience_skills_form")["Add-Skill"])) {
                $session->remove("JobId");
                return $this->redirectToRoute('app_cv_edit');
            }

            $job = $doctrine->getRepository(CvJobExperience::class)->find($session->get("JobId"));
            $jobSkill->setJob($job);
            $entityManager->persist($jobSkill);
            $entityManager->flush();

            return $this->redirectToRoute('app_cv_work_experience_skill_edit');
        }
        return $this->render('cv_work_experience_skill_edit/index.html.twig', [
            'job_skill_form' => $form->createView(),
            'skills' => $skills
        ]);
    }
}
