<?php

namespace App\DataFixtures;

use App\Entity\StudentDetail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentDetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 5; $i++){
            $student = new StudentDetail();
            $student->setAddress("Ha Noi");
            $student->setImage("Hihi");
            $student->setBirthday(\DateTime::createFromFormat('Y-m-d','1996-10-15'));
            $student->setPhone("0123456789");
            $student->setEmail("aloalo$i@fpt.edu.vn");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
