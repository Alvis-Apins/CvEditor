<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvPicture;
use App\Form\PictureFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvPhotoEditController extends AbstractController
{
    #[Route('/cv-photo', name: 'app_cv_photo_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $picture = new CvPicture();
        $session = $request->getSession();

        $form = $this->createForm(PictureFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get("picture_form")["file_name"];
            $uploadsDirectory = $this->getParameter('uploads_directory');
            $cv = $session->get("CvId");
            $filename = 'picture' . $cv . '.' . $file->guessExtension();
            $file->move(
                $uploadsDirectory,
                $filename
            );
            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $picture->setCv($cv);
            $picture->setFileName($filename);
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }


        return $this->render('cv_photo_edit/index.html.twig', [
            'picture_form' => $form->createView()
        ]);
    }
}
