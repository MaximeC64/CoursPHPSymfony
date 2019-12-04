<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1 ; $i <= 5 ; $i++){
            $name = $faker->word;
            $categorie = new Categorie();
            $categorie->setNom($name);
            $manager->persist($categorie);
            for ($y = 1 ; $y <= 4 ; $y++){
                $produit = new Produit();
                $produit->setLibelle($faker->word);
                $produit->setPrix($faker->randomFloat(2, 10.00, 100.00));
                $produit->setCategorie($categorie);
                $manager->persist($produit);
            }
        }
        $manager->flush();
    }
}
