<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 5; $i++){
            $student = new Student();
            $student->setName("Student $i");
            $student->setCode("GCH $i");
            $student->setGender("None");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
