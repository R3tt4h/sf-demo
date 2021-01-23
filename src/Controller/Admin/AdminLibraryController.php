<?php

namespace App\Controller\Admin;

use App\Form\BooksType;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Books;
use Symfony\Component\HttpFoundation\Response;


class AdminLibraryController extends AbstractController
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
     * @Route("/admin", name="admin.library.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $books = $this->repository->findAll();
        return $this->render('admin/library/index.html.twig', compact('books'));
    }

    /**
     * @Route("/admin/library/create", name="admin.library.new")
     */
    public function new(Request $request)
    {
        $book = new Books();
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($book);
            $this->em->flush();
            $this->addFlash('success', 'Le livre a bien été créé !');

            return $this->redirectToRoute('admin.library.index');
        }
        return $this->render('admin/library/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/admin/library/{id}", name="admin.library.delete", methods="DELETE")
     * @param Books $book
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Books $book, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $request->get('_token') ))
        {
            $this->em->remove($book);
            $this->em->flush();
            $this->addFlash('success', 'Le livre a bien été supprimé !');

        }

        return $this->redirectToRoute('admin.library.index');

    }

    /**
     * @Route("/admin/library/{id}", name="admin.library.edit")
     */
    public function edit(Books $book, Request $request)
    {
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le livre a bien été modifié !');
            return $this->redirectToRoute('admin.library.index');
        }
        return $this->render('admin/library/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

}
