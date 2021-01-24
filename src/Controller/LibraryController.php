<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    /**
     * @var BooksRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(BooksRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/library", name="library")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $books = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1), 12 /*page number*/

        );

        return $this->render('library/index.html.twig', [
            'current_menu' => 'libraries',
            'books' => $books
        ]);
    }

    /**
     * @Route("/library/{slug}-{id}", name="library.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Books $book
     * @return Response
     */
    public function show(Books $book, string $slug): Response
    {
        if($book->getSlug() !== $slug){
            $this->redirectToRoute('library.show', [
                'id' => $book->getId(),
                'slug' => $book->getSlug()
            ], 301);
        }
        return $this->render('library/show.html.twig', [
            'book' => $book,
            'current-menu' => 'libraries'
        ]);
    }


}
