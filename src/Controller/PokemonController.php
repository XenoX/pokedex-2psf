<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokedexRepository;
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
    #[Route('/update/{id}', name: 'app_pokemon_update')]
    public function createOrUpdate(?Pokemon $pokemon, Request $request, PokemonRepository $pokemonRepository): Response
    {
        $action = 'modifié';
        if (null === $pokemon) {
            $action = 'ajouté';
            $pokemon = new Pokemon();
        }

        $form = $this->createForm(PokemonType::class, $pokemon);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemonRepository->save($pokemon, true);

            $this->addFlash('success', 'Pokemon '.$action.' avec succès !');

            return $this->redirectToRoute('app_pokemon_index');
        }

        return $this->render('pokemon/createOrUpdate.html.twig', [
            'form' => $form,
            'pokemon' => $pokemon,
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
    public function delete(Pokemon $pokemon, PokemonRepository $pokemonRepository, PokedexRepository $pokedexRepository): Response
    {
        $pokedexes = $pokedexRepository->findBy(['pokemon' => $pokemon]);
        foreach ($pokedexes as $pokedex) {
            $pokedexRepository->remove($pokedex, true);
        }
        $pokemonRepository->remove($pokemon, true);

        return $this->redirectToRoute('app_pokemon_index');
    }
}
