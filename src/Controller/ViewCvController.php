<?php

namespace App\Controller;

use App\Repository\CvBaseInfoRepository;
use App\Repository\CvJobExperienceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ViewCvController extends AbstractController
{
    private CvBaseInfoRepository $cvBaseInfoRepository;
    private CvJobExperienceRepository $cvJobExperienceRepository;

    public function __construct(CvBaseInfoRepository $cvBaseInfoRepository, CvJobExperienceRepository $cvJobExperienceRepository) {

        $this->cvBaseInfoRepository = $cvBaseInfoRepository;
        $this->cvJobExperienceRepository = $cvJobExperienceRepository;
    }

    #[Route('/view-cv', name: 'app_view_cv')]
    public function index(ManagerRegistry $registry): Response
    {
        $session = new Session();
        $cv = $session->get("CvId");

        if ($cv == null) {
            return $this->redirectToRoute('app_cv_list');
        }

        $baseInfo = $this->cvBaseInfoRepository->find($cv);
        $address = $baseInfo->getAddresses()->first();
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

        return $this->render('view_cv/index.html.twig', [
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
