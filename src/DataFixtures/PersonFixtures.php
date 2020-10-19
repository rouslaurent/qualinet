<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i<=100; $i++){
            
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
