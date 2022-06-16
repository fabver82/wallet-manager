<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $user = new User();
        $user->setUsername('user1');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('1111');
        $manager->persist($user);
        $manager->flush();
    }
}
