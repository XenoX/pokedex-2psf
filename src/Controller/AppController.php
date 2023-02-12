<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app_index')]
    public function index(): Response
    {
        $pokemons = [
            [
                'id' => 1,
                'name' => 'bulbasaur',
                'number' => 1,
                'types' => ['poison'],
                'image' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png',
                'seenAt' => new \DateTimeImmutable(),
                'captured' => true,
                'capturedAt' => new \DateTimeImmutable(),
            ],
            [
                'id' => 2,
                'name' => 'charmander',
                'number' => 4,
                'types' => ['fire'],
                'image' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png',
                'seenAt' => new \DateTimeImmutable(),
                'captured' => false,
                'capturedAt' => null,
            ],
        ];

        return $this->render('app/index.html.twig', [
            'pokemons' => $pokemons,
        ]);
    }
}
