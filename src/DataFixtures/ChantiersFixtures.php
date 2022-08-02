<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Chantier;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ChantiersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 40 ; $i++) { 
            
            $chantier = new Chantier();
            $chantier->setName($faker->company())
                 ->setAddress($faker->streetAddress())
                 ->setStartsAt($faker->dateTimeBetween('+2 week', '+2 years'));
               

                 $manager->persist($chantier);
        }

        $manager->flush();
    }
}
