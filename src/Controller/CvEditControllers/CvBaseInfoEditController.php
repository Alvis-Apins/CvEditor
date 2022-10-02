<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Form\BaseInfoFormType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvBaseInfoEditController extends AbstractController
{
    #[Route('/cv-base-info', name: 'app_edit_cv')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $baseInfo = new CvBaseInfo();
        $form = $this->createForm(BaseInfoFormType::class, $baseInfo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($baseInfo);
            $entityManager->flush();

            $session = new Session();
            $session->set('CvId', $baseInfo->getId());

            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('edit_cv/index.html.twig', [
            'base_info_form' => $form->createView()
        ]);
    }


}
