<?php 
namespace App\Controller;

use App\Entity\Person;
use App\Entity\PersonSearch;
use App\Form\PersonSearchType;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
    
    public function index(PaginatorInterface $paginator, Request $request): Response{
        $search = new PersonSearch();
        $form = $this->createForm(PersonSearchType::class, $search);
        $form -> handleRequest($request);

        $persons = $paginator->paginate(
            $this->repository->findAllActiveQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        
        return $this->render('person/index.html.twig', [
            'current_menu' => 'persons',
            'persons' => $persons,
            'form' => $form->createView()
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