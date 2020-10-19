<?php

namespace App\Controller\Admin;

use App\Entity\Localisation;
use App\Form\LocalisationType;
use App\Repository\LocalisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/localisation")
 */
class AdminLocalisationController extends AbstractController
{
    /**
     * @Route("/", name="admin.localisation.index", methods={"GET"})
     */
    public function index(LocalisationRepository $localisationRepository): Response
    {
        return $this->render('admin/localisation/index.html.twig', [
            'localisations' => $localisationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.localisation.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $localisation = new Localisation();
        $form = $this->createForm(LocalisationType::class, $localisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($localisation);
            $entityManager->flush();

            return $this->redirectToRoute('admin.localisation.index');
        }

        return $this->render('admin/localisation/new.html.twig', [
            'localisation' => $localisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.localisation.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Localisation $localisation): Response
    {
        $form = $this->createForm(LocalisationType::class, $localisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.localisation.index');
        }

        return $this->render('admin/localisation/edit.html.twig', [
            'localisation' => $localisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.localisation.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Localisation $localisation): Response
    {
        if ($this->isCsrfTokenValid('admin/delete'.$localisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($localisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.localisation.index');
    }
}
