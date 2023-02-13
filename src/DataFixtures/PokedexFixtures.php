<?php

namespace App\DataFixtures;

use App\Entity\Pokedex;
use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PokedexFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            /** @var Pokemon $pokemon */
            $pokemon = $this->getReference($data[3]);

            $object = (new Pokedex())
                ->setCaptured($data[0])
                ->setSeenAt($data[1])
                ->setCapturedAt($data[2])
                ->setPokemon($pokemon)
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [true, new \DateTimeImmutable(), new \DateTimeImmutable(), 'bulbasaur'],
            [false, new \DateTimeImmutable(), null, 'charmander'],
            [false, new \DateTimeImmutable(), null, 'squirtle'],
            [false, new \DateTimeImmutable(), null, 'rattata'],
            [true, new \DateTimeImmutable(), new \DateTimeImmutable(), 'pikachu'],
        ];
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
            PokemonFixtures::class,
        ];
    }
}
