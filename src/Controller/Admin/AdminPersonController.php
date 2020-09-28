<?php

namespace App\Controller\Admin;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPersonController extends AbstractController
{

    /**
     * @var PersonRepository
     */
    private $repository;

    public function __construct(PersonRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.person.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $persons = $this->repository->findAll();
        return $this->render('admin/person/index.html.twig', compact('persons'));
    }

    /**
     * Undocumented function
     * @Route("/admin/person/create", name="admin.person.new")
     * @return void
     */
    public function new(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($person);
            $this->em->flush();
            $this->addFlash('success', 'Personne créée avec succès');
            return $this->redirectToRoute('admin.person.index');
        }
        return $this->render('admin/person/new.html.twig', [
            'person' => $person,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/person/{id}", name="admin.person.edit", methods="GET|POST")
     * @param Person $person
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Person $person, Request $request)
    {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Informations modifiée avec succès');
            return $this->redirectToRoute('admin.person.index');
        }
        return $this->render('admin/person/edit.html.twig', [
            'person' => $person,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/person/{id}", name="admin.person.delete", methods="DELETE")
     * @param Person $person
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Person $person, Request $request) 
    {
        if($this->isCsrfTokenValid('delete'.$person->getId(), $request->get('_token'))){
            $this->em->remove($person);
            $this->em->flush();
            $this->addFlash('success', 'Personne supprimée avec succès');
        }
        return $this->redirectToRoute('admin.person.index');
    }
}
