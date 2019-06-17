<?php

namespace App\Controller;

use App\Entity\Tea;
use App\Form\TeaType;
use App\Repository\TeaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tea")
 */
class TeaController extends AbstractController
{
    /**
     * @Route("/", name="tea.index", methods={"GET"})
     */
    public function index(TeaRepository $teaRepository): Response
    {
        return $this->render('tea/index.html.twig', [
            'teas' => $teaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tea.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tea = new Tea();
        $form = $this->createForm(TeaType::class, $tea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tea);
            $entityManager->flush();

            return $this->redirectToRoute('tea.index');
        }

        return $this->render('tea/new.html.twig', [
            'tea' => $tea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea.show", methods={"GET"})
     */
    public function show(Tea $tea): Response
    {
        return $this->render('tea/show.html.twig', [
            'tea' => $tea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tea.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tea $tea): Response
    {
        $form = $this->createForm(TeaType::class, $tea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tea.index', [
                'id' => $tea->getId(),
            ]);
        }

        return $this->render('tea/edit.html.twig', [
            'tea' => $tea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tea $tea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tea.index');
    }
}
