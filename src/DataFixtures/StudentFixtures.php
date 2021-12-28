<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=5; $i++) {
            $student = new Student();
            $student -> setName ("Lo thi Hoa", $i);
            $student -> setBirthday(\DateTime::createFromFormat('Y-m-d', '1999-05-10'));
            $student -> setImage("student.jpg");
            $student -> setAddress("Ha noi");
            $student -> setPhone("12345");
            $student ->setEmail("hoa12@gmail.com");
            $manager ->persist($student);
        }

        $manager->flush();
    }
}
