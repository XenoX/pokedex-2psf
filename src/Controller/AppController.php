<?php

namespace App\Controller;

use App\Repository\PokedexRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/')]
    public function index(PokedexRepository $pokedexRepository): Response
    {
        return $this->render('app/index.html.twig', [
            'pokedexes' => $pokedexRepository->findBy(['user' => $this->getUser()]),
        ]);
    }
}
