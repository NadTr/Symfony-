<?php

namespace App\Controller;

use App\Entity\Tea;
use App\Entity\Book;
use App\Entity\Reader;
use App\Form\ReaderType;
use App\Repository\ReaderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reader")
 */
class ReaderController extends AbstractController
{
    /**
     * @Route("/", name="reader.index", methods={"GET"})
     */
    public function index(ReaderRepository $readerRepository): Response
    {
        return $this->render('reader/index.html.twig', [
            'readers' => $readerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reader.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reader = new Reader();
        $form = $this->createForm(ReaderType::class, $reader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reader);
            $entityManager->flush();

            return $this->redirectToRoute('reader.index');
        }

        return $this->render('reader/new.html.twig', [
            'reader' => $reader,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reader.show", methods={"GET"})
     */
    public function show(Reader $reader): Response
    {
        return $this->render('reader/show.html.twig', [
            'reader' => $reader,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reader.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reader $reader): Response
    {
        $form = $this->createForm(ReaderType::class, $reader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reader.index', [
                'id' => $reader->getId(),
            ]);
        }

        return $this->render('reader/edit.html.twig', [
            'reader' => $reader,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reader.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reader $reader): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reader->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reader);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reader.index');
    }
}
