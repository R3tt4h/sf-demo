<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LibraryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++)
        {
            $book = new Books();
            $book
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(5, true));
            $manager->persist($book);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
