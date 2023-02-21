<?php

namespace App\DataFixtures;

use App\Entity\Multiplier;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MultiplierFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            /** @var Type $attacker */
            $attacker = $this->getReference($data[0]);
            /** @var Type $defender */
            $defender = $this->getReference($data[1]);

            $object = (new Multiplier())
                ->setAttacker($attacker)
                ->setDefender($defender)
                ->setValue($data[2])
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['fire', 'fire', 0.5],
            ['fire', 'water', 0.5],
            ['fire', 'grass', 2],
            ['water', 'fire', 2],
            ['water', 'water', 0.5],
            ['water', 'grass', 0.5],
            ['electric', 'water', 2],
            ['electric', 'electric', 0.5],
            ['electric', 'grass', 0.5],
            ['grass', 'fire', 0.5],
            ['grass', 'water', 2],
            ['grass', 'grass', 0.5],
        ];
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
        ];
    }
}
