<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pokemons')]
class PokemonController extends AbstractController
{
    #[Route('', name: 'app_pokemon_index')]
    public function index(): Response
    {
        $pokemons = $this->getPokemons();

        return $this->render('pokemon/index.html.twig', [
            'pokemons' => $pokemons,
        ]);
    }

    #[Route('/create', name: 'app_pokemon_create')]
    public function create(): Response
    {
        // Create form for add a Pokemon
        // Handle form if submitted
        return $this->render('pokemon/create.html.twig');
    }

    #[Route('/{id}', name: 'app_pokemon_show')]
    public function show(int $id): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $this->getPokemons()[$id - 1],
        ]);
    }

    #[Route('/delete/{id}', name: 'app_pokemon_delete')]
    public function delete(): Response
    {
        // Remove Pokemon in the database
        return $this->redirectToRoute('app_pokemon_index');
    }

    private function getPokemons(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'bulbasaur',
                'number' => 1,
                'types' => ['poison'],
                'image' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png',
            ],
            [
                'id' => 2,
                'name' => 'charmander',
                'number' => 4,
                'types' => ['fire'],
                'image' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png',
            ],
        ];
    }
}
