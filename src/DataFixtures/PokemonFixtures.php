<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            /** @var Type $type */
            $type = $this->getReference($data[3]);

            $object = (new Pokemon())
                ->setName($data[0])
                ->setNumber($data[1])
                ->setImage($data[2])
                ->addType($type)
            ;

            $this->addReference(strtolower($data[0]), $object);

            $manager->persist($object);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['Bulbasaur', 1, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png', 'grass'],
            ['Charmander', 4, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png', 'fire'],
            ['Squirtle', 7, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png', 'water'],
            ['Rattata', 19, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/019.png', 'normal'],
            ['Pikachu', 25, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png', 'electric'],
        ];
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
        ];
    }
}
