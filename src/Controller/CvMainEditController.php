<?php

namespace App\Controller;

use App\Entity\CvAddress;
use App\Entity\CvEducation;
use App\Entity\CvJobExperience;
use App\Entity\CvJobExperienceSkills;
use App\Entity\CvLanguages;
use App\Entity\CvReferences;
use App\Entity\CvWebLinks;
use App\Repository\CvBaseInfoRepository;
use App\Repository\CvJobExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvMainEditController extends AbstractController
{

    private CvBaseInfoRepository $cvBaseInfoRepository;
    private CvJobExperienceRepository $cvJobExperienceRepository;
    private EntityManagerInterface $entityManager;


    public function __construct(CvBaseInfoRepository $cvBaseInfoRepository, CvJobExperienceRepository $cvJobExperienceRepository, EntityManagerInterface $entityManager)
    {
        $this->cvBaseInfoRepository = $cvBaseInfoRepository;
        $this->cvJobExperienceRepository = $cvJobExperienceRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/cv-edit', name: 'app_cv_edit')]
    public function index(Request $request): Response
    {
        $action = $request->request->get('action');

        if ($action == 'photo') return $this->redirectToRoute('app_cv_photo_edit');
        if ($action == 'create') return $this->redirectToRoute('app_view_cv');
        if ($action !== null){
            return $this->redirectToRoute("app_" . $action);
        }

        $session = new Session();
        $cv = $session->get("CvId");
        if ($cv === null) {
            return $this->render('cv_main_edit/index.html.twig', []);
        } else {
            $baseInfo = $this->cvBaseInfoRepository->find($cv);
            $baseInfo->setAbout(substr($baseInfo->getAbout(), 0, 60) . "...");

            $address = $baseInfo->getAddresses()->get(0);
            $education = $baseInfo->getEducations()->getValues();
            $workExperience = $this->cvJobExperienceRepository->findBy(["cv" => $cv]);
            $workExperienceSkills = [];
            foreach ($workExperience as $experience){
                $workExperienceSkills[] = $experience->getSkills()->getValues();
            }
            $languages = $baseInfo->getLanguages()->getValues();
            $references = $baseInfo->getCvReferences()->getValues();
            $webLinks = $baseInfo->getUrls()->getValues();
            $picture = $baseInfo->getPictures()->first();

            return $this->render('cv_main_edit/index.html.twig', [
                'base_info' => $baseInfo,
                'address' => $address,
                'educations' => $education,
                'work_experiences' => $workExperience,
                'work_experience_skills' => $workExperienceSkills,
                'languages' => $languages,
                'references' => $references,
                'web_links' => $webLinks,
                'picture' => $picture
            ]);
        }
    }

    #[Route('/cv-main-edit', name: 'app_cv_main_edit')]
    public function edit(Request $request): Response
    {
        $session = $request->getSession();

        if ($request->request->get('base') != null) {
            $session->set('Edit-Base', $request->request->get('base'));
            return $this->redirectToRoute('app_edit_cv');
        }
        if ($request->request->get('address') != null) {
            $session->set('Edit-Address', $request->request->get('address'));
            return $this->redirectToRoute('app_cv_address_edit');
        }
        if ($request->request->get('education') != null) {
            $session->set('Edit-Education', $request->request->get('education'));
            return $this->redirectToRoute('app_cv_education_edit');
        }
        if ($request->request->get('work') != null) {
            $session->set('Edit-Work', $request->request->get('work'));
            return $this->redirectToRoute('app_cv_work_experience_edit');
        }
        if ($request->request->get('skill') != null) {
            $session->set('Edit-Skill', $request->request->get('skill'));
            return $this->redirectToRoute('app_cv_work_experience_skill_edit');
        }
        if ($request->request->get('language') != null) {
            $session->set('Edit-Language', $request->request->get('language'));
            return $this->redirectToRoute('app_cv_language_edit');
        }
        if ($request->request->get('link') != null) {
            $session->set('Edit-Link', $request->request->get('link'));
            return $this->redirectToRoute('app_cv_web_links_edit');
        }
        if ($request->request->get('reference') != null) {
            $session->set('Edit-Reference', $request->request->get('reference'));
            return $this->redirectToRoute('app_cv_references_edit');
        }
        return $this->redirectToRoute('app_cv_main_edit');
    }

    #[Route('/cv-main-delete', name: 'app_cv_main_delete')]
    public function delete(Request $request): Response
    {
        if ($request->request->get('address') != null) {
            $entity = $this->entityManager->find(CvAddress::class, $request->request->get('address'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('education') != null) {
            $entity = $this->entityManager->find(CvEducation::class, $request->request->get('education'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('work') != null) {
            $entity = $this->entityManager->find(CvJobExperience::class, $request->request->get('work'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('skill') != null) {
            $entity = $this->entityManager->find(CvJobExperienceSkills::class, $request->request->get('skill'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('language') != null) {
            $entity = $this->entityManager->find(CvLanguages::class, $request->request->get('language'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('reference') != null) {
            $entity = $this->entityManager->find(CvReferences::class, $request->request->get('reference'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        if ($request->request->get('link') != null) {
            $entity = $this->entityManager->find(CvWebLinks::class, $request->request->get('link'));
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }
        
        return $this->redirectToRoute('app_cv_list');
    }
}
