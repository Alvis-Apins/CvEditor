<?php

namespace App\Controller\CvEditControllers;
use App\Entity\CvAddress;
use App\Entity\CvBaseInfo;
use App\Form\AddressFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CvAddressEditController extends AbstractController
{
    #[Route('/cv-address', name: 'app_cv_address_edit')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $address = new CvAddress();
        $session = new Session();
        $form = $this->createForm(AddressFormType::class, $address);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $doctrine->getRepository(CvBaseInfo::class)->find($session->get("CvId"));
            $address->setCv($cv);
            $entityManager->persist($address);
            $entityManager->flush();

            return $this->redirectToRoute('app_cv_edit');
        }

        return $this->render('cv_address_edit/index.html.twig', [
            'address_form' => $form->createView()
        ]);
    }
}
