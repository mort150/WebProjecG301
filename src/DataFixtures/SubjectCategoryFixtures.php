<?php

namespace App\DataFixtures;

use App\Entity\SubjectCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=5; $i++){
            $class = new SubjectCategory();
            $class->setName("SubjectCategory $i");
            $class->setDescription("Description $i");
            $manager->persist($class);
        }

        $manager->flush();
    }
}
