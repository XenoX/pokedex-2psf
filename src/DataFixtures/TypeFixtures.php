<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $object = (new Type())
                ->setName($data[0])
                ->setColor($data[1])
            ;

            $this->addReference(strtolower($data[0]), $object);

            $manager->persist($object);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['Normal', '#a5a374'],
            ['Fire', '#ed7829'],
            ['Water', '#678bef'],
            ['Electric', '#f7c924'],
            ['Grass', '#63ae3e'],
        ];
    }
}
