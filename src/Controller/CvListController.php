<?php

namespace App\Controller;

use App\Repository\CvBaseInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvListController extends AbstractController
{
    private CvBaseInfoRepository $cvBaseInfoRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CvBaseInfoRepository $cvBaseInfoRepository, EntityManagerInterface $entityManager)
    {
        $this->cvBaseInfoRepository = $cvBaseInfoRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/cv-list', name: 'app_cv_list')]
    public function index(): Response
    {
        $session = new Session();
        $session->set("CvId", null);

        $cvs = $this->cvBaseInfoRepository->findAll();

        return $this->render('cv_list/index.html.twig', [
            'cvs' => $cvs,
        ]);
    }

    #[Route('/cv-list-edit', name: 'app_cv_list_edit')]
    public function edit(Request $request): Response
    {
        $session = new Session();
        $cv = $request->request->get('cv_id');
        $session->set('CvId', $cv);

        return $this->redirectToRoute('app_cv_edit');
    }

    #[Route('/cv-list-view', name: 'app_cv_list_view')]
    public function show(Request $request): Response
    {
        $session = new Session();
        $cv = $request->request->get('cv_id');
        $session->set('CvId', $cv);

        return $this->redirectToRoute('app_view_cv');
    }

    #[Route('/cv-list-delete', name: 'app_cv_list_delete')]
    public function delete(Request $request): Response
    {
        $cvId = $request->request->get('cv_id');
        $cv = $this->cvBaseInfoRepository->find($cvId);
        $this->entityManager->remove($cv);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_cv_list');
    }

}
