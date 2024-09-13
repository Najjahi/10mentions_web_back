<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use EsperoSoft\Faker\Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();
        // $product = new Product();
        // $manager->persist($product);

        $categories = [];

        for ($i = 0; $i < 6; $i++) {

            $categorie = new Categorie();
            // je commence par crée mes catégories 

            $categorie->setName($faker->word());
            $categorie->setDescription($faker->text());
            $categorie->setCreatedAt($faker->dateTimeImmutable());
            $categories[] = $categorie; // à chaque toure je stock la catégorie dans le tableau.
            $manager->persist($categorie); // à chaque toute de boucles je fige les données pour les inserrer ensuite dans la BDD avec la méthode flush() 

        }

        for ($i = 0; $i < 50; $i++) {

            $article = (new Article())->setTitle($faker->word(4))
                ->setContent($faker->text())
                ->setImage($faker->image())
                ->setCreatedAt($faker->dateTimeImmutable())
                ->addCategorie($categories[rand(0, count($categories)-1)]);
                $manager->persist($article);
        }

        $manager->flush(); // l'etape qui va envoyer les information dans la BDD
    }
}
