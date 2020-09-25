<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController {
    /**
     * @return Response
     * @Route("/persons", name="person.index")
     */
    
    public function index(): Response{
        return $this->render('person/index.html.twig', [
            'current_menu' => 'persons'
        ]);
    }
}