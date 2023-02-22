<?php

namespace App\Controller;

use App\Entity\Pokedex;
use App\Form\PokedexType;
use App\Repository\PokedexRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/pokedex')]
class PokedexController extends AbstractController
{
    #[Route('/add')]
    public function add(Request $request, PokedexRepository $pokedexRepository, ValidatorInterface $validator): Response
    {
        $pokedex = new Pokedex();
        $form = $this->createForm(PokedexType::class, $pokedex);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokedex->setUser($this->getUser());

            $errors = $validator->validate($pokedex);
            if ($errors->count() > 0) {
                $error = new FormError($errors->get(0)->getMessage());
                $form->addError($error);

                return $this->render('pokedex/add.html.twig', [
                    'form' => $form,
                ]);
            }

            $pokedexRepository->save($pokedex, true);

            $this->addFlash('success', 'Pokemon bien ajouté au Pokedex');

            return $this->redirectToRoute('app_app_index');
        }

        return $this->render('pokedex/add.html.twig', [
            'form' => $form,
        ]);
    }
}
