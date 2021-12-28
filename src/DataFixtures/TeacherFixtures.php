<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=5; $i++) {
            $teacher = new Teacher();
            $teacher -> setName ("Lo thi Hoa", $i);
            $teacher -> setImage("teacher.jpg");
            $teacher -> setsubject("Java");
            $teacher -> setPhone("12345");
            $teacher ->setEmail("hoa12@gmail.com");
            $manager ->persist($teacher);
        }

        $manager->flush();
    }
}
