<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Form\BaseInfoFormType;
use App\Repository\CvBaseInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvBaseInfoEditController extends AbstractController
{
    #[Route('/cv-base-info', name: 'app_edit_cv')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $baseInfo = new CvBaseInfo();
        $session = $request->getSession();

        if ($session->get("Edit-Base") != null) {
            $baseInfoRepository = new CvBaseInfoRepository($doctrine);
            $baseInfo = $baseInfoRepository->find($session->get("Edit-Base"));
        }

        $form = $this->createForm(BaseInfoFormType::class, $baseInfo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($baseInfo);
            $entityManager->flush();

            $session->set('CvId', $baseInfo->getId());
            $session->remove("Edit-Base");
            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('edit_cv/index.html.twig', [
            'base_info' => $baseInfo,
            'base_info_form' => $form->createView()
        ]);
    }


}
