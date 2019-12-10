<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

//Generateur de noms cohérents aléatoires
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //Mise en place de Faker
        $faker = Faker\Factory::create('fr_FR');

        //Création de 10 utilisateurs (nom d'utilisateur, mot de passe, rôle)
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'symfony87'
            ));
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
