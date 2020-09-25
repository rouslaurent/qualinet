<?php 
namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonController extends AbstractController {

    /**
     * @var PersonRepository
     */
    
     private $repository;

     public function __construct(PersonRepository $repository)
     {
        $this->repository = $repository;
     }

    /**
     * @return Response
     * @Route("/persons", name="person.index")
     */
    
    public function index(): Response{
        $persons = $this->repository->findAllActive();
        return $this->render('person/index.html.twig', [
            'current_menu' => 'persons',
            'persons' => $persons
        ]);
    }
    /**
     * @Route("/persons/{slug}-{id}", name="person.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Person $person
     * @return Response
     */

    public function show(Person $person, string $slug): Response{

        if($person->getSlug() !== $slug){
            return $this->redirectToRoute('person.show', [
                'id' => $person->getId(),
                'slug' => $person->getSlug()
            ], 301);
        }
        
        return $this->render('person/show.html.twig', [
            'person' => $person,
            'current_menu' => 'persons'
        ]);
    }
}