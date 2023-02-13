<?php

namespace App\Controller;

use App\Repository\PokedexRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app_index')]
    public function index(PokedexRepository $pokedexRepository): Response
    {
        return $this->render('app/index.html.twig', [
            'pokemons' => $pokedexRepository->findAll(),
        ]);
    }
}
