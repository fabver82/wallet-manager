<?php

namespace App\DataFixtures;

use App\Entity\AccountMovement;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;




class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('user1');
        $user->setRoles(['ROLE_USER']);
        $plaintextPassword = '1111';
        $hashedPassword = $this->passwordHasher->hashPassword($user,$plaintextPassword);
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();

        $faker = Factory::create();
        for ($i=0;$i<20;$i++){
            $movement = new AccountMovement();
            $movement->setcomment($faker->words(3,true));
            $movement->setAmount($faker->randomFloat(2,1,100000));
            $movement->setType($faker->randomElement(['income','expense']));
            $manager->persist($movement);

        }
        $manager->flush();
    }
}
