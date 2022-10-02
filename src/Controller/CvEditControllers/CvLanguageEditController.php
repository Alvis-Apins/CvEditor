<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvLanguages;
use App\Form\LanguageFormType;
use App\Repository\CvLanguagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvLanguageEditController extends AbstractController
{
    #[Route('/cv-language', name: 'app_cv_language_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $language = new CvLanguages();
        $session = $request->getSession();

        if ($session->get("Edit-Language") != null) {
            $languageRepository = new CvLanguagesRepository($doctrine);
            $language = $languageRepository->find($session->get("Edit-Language"));
        }

        $form = $this->createForm(LanguageFormType::class, $language);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $language->setCv($cv);
            $entityManager->persist($language);
            $entityManager->flush();
            $session->remove("Edit-Language");

            return $this->redirectToRoute('app_cv_edit');
        }


        return $this->render('cv_language_edit/index.html.twig', [
            'language' => $language,
            'language_form' => $form->createView()
        ]);
    }
}
