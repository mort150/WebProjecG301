<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 5; $i++){
            $teacher = new Teacher();
            $teacher->setName("Teacher $i");
            $teacher->setImage("Hihi");
            $teacher->setGender("Hihi");
            $teacher->setBirthday(\DateTime::createFromFormat('Y-m-d','1996-10-15'));
            $teacher->setPhone("0123456789");
            $teacher->setEmail("aloalo$i@fpt.edu.vn");
            $manager->persist($teacher);
        }
        $manager->flush();
    }
}
