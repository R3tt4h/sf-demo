<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param BooksRepository $repository
     * @return Response
     */
    public function index(BooksRepository $repository): Response
    {
        $books = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'books' => $books
        ]);
    }


}
