<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=5; $i++){
            $class = new Subject();
            $class->setName("Subject $i");
            $class->setCode("167$i");
            $class->setDescription("Description $i");
            $class->setCredit(rand(10,19));
            $manager->persist($class);
        }

        $manager->flush();
    }
}
