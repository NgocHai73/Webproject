<?php

namespace App\DataFixtures;
use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=5; $i++) {
            $course = new Course();
            $course -> setName ("CGh0904");
            $course -> setMember("dongntgchh190626");
            $course -> setCode ("gch190626");
            $course ->setNote("");
            $manager ->persist($course);
        }
        $manager->flush();
    }
}
