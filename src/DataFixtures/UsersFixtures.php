<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i <10 ; $i++) { 
            
            $user = new User();
            $user->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setMatricule($faker->randomNumber(5, true))
                 ->setPassword($faker->password());

                 $manager->persist($user);
        }

        $manager->flush();
    }
}
