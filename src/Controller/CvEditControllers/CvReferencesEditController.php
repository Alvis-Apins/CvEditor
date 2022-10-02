<?php

namespace App\Controller\CvEditControllers;

use App\Entity\CvBaseInfo;
use App\Entity\CvReferences;
use App\Form\ReferencesFormType;
use App\Repository\CvReferencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvReferencesEditController extends AbstractController
{
    #[Route('/cv-references', name: 'app_cv_references_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $reference = new CvReferences();
        $session = $request->getSession();

        if ($session->get("Edit-Reference") != null) {
            $referenceRepository = new CvReferencesRepository($doctrine);
            $reference = $referenceRepository->find($session->get("Edit-Reference"));
        }

        $form = $this->createForm(ReferencesFormType::class, $reference);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $reference->setCv($cv);
            $entityManager->persist($reference);
            $entityManager->flush();
            $session->remove("Edit-Reference");

            return $this->redirectToRoute('app_cv_edit');
        }


        return $this->render('cv_references_edit/index.html.twig', [
            'reference' => $reference,
            'reference_form' => $form->createView()
        ]);
    }
}
