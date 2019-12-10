<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Repository\ArticleRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

//Generateur de noms cohérents aléatoires
use Faker;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Mise en place de Faker
        $faker = Faker\Factory::create('fr_FR');
        
        //Création de 10 articles
        for ($i = 0; $i < 10; $i++) {
            $fake_article = new Article();
            $fake_article->setTitle($faker->text($maxNbChars = rand(10,30)));
            $fake_article->setContent($faker->text($maxNbChars = rand(50,255)));
            $fake_article->setSignature('Article généré par ArticleFixtures.php');
            $fake_article->setPublicationDate($faker->dateTime($max = 'now'));
            $fake_article->setAuthor('FAKER');

            $manager->persist($fake_article);
        }
        $manager->flush();
    }
}
