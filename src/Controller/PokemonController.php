<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function create(PokemonRepository $pokemonRepository, TypeRepository $typeRepository): Response
    {
        $pokemonRepository->save(
            (new Pokemon())
                ->setName('Raichu')
                ->setNumber(26)
                ->setImage('https://assets.pokemon.com/assets/cms2/img/pokedex/full/026.png')
                ->addType($typeRepository->findOneBy(['name' => 'Electric'])),
            true,
        );

        return $this->redirectToRoute('app_pokemon_index');
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
