<?php

namespace App\DataFixtures;

use App\Entity\Pokedex;
use App\Entity\Pokemon;
use App\Entity\User;
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
            /** @var User $user */
            $user = $this->getReference($data[4]);

            $object = (new Pokedex())
                ->setCaptured($data[0])
                ->setSeenAt($data[1])
                ->setCapturedAt($data[2])
                ->setPokemon($pokemon)
                ->setUser($user)
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [true, new \DateTimeImmutable(), new \DateTimeImmutable(), 'bulbasaur', 'user'],
            [false, new \DateTimeImmutable(), null, 'charmander', 'user'],
            [false, new \DateTimeImmutable(), null, 'squirtle', 'admin'],
            [false, new \DateTimeImmutable(), null, 'rattata', 'admin'],
            [true, new \DateTimeImmutable(), new \DateTimeImmutable(), 'pikachu', 'admin'],
        ];
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            PokemonFixtures::class,
        ];
    }
}
