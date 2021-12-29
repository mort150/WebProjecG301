<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setUsername("admin");
        $user->setPassword($this->hasher->hashPassword($user, '123123'));
        $manager->persist($user);

        $manager->flush();
    }
}
