<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pokemons')]
class PokemonController extends AbstractController
{
    #[Route('', name: 'app_pokemon_index')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/index.html.twig', [
            'pokemons' => $pokemonRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'app_pokemon_create')]
    public function create(Request $request, PokemonRepository $pokemonRepository): Response
    {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemonRepository->save($pokemon, true);

            return $this->redirectToRoute('app_pokemon_index');
        }

        return $this->render('pokemon/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_pokemon_show')]
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_pokemon_delete')]
    public function delete(Pokemon $pokemon, PokemonRepository $pokemonRepository): Response
    {
        $pokemonRepository->remove($pokemon, true);

        return $this->redirectToRoute('app_pokemon_index');
    }
}
