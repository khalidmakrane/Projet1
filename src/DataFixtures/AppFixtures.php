<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Generator;

class AppFixtures extends Fixture
{
   
   
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 10; $i++) { 
             $user= new User();
            $user->setName('user'. $i);
            $user->setEmail('user@gmail.com');
            $user->setPassword('12345');
            $user->setAge(mt_rand(20,44));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
