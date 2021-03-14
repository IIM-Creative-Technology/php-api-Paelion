<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Mark;
use App\Entity\Promotion;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $adminMembers = ['alexis.bougy', 'karine.mousdik', 'nicolas.rauber'];

        foreach ($adminMembers as $member) {
            $user = new User;
            $user->setEmail($member . '@devinci.fr');
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));

            $manager->persist($user);
        }

        for ($i = 1; $i <= 5; $i++) {
            $promotion = new Promotion;
            $promotion->setName('Promotion A' . $i);

            switch ($i) {
                case 1:
                    $promotion->setYear('2025');
                    break;
                case 2:
                    $promotion->setYear('2024');
                    break;
                case 3:
                    $promotion->setYear('2023');
                    break;
                case 4:
                    $promotion->setYear('2022');
                    break;
                case 5:
                    $promotion->setYear('2021');
                    break;
            }

            $this->setStudent($promotion, $manager);

            $manager->persist($promotion);
        }


        for ($i = 1; $i <= 50; $i++) {
            $teacher = new Teacher;
            $teacher->setLastName('Nom de famille' . $i);
            $teacher->setFirstName('Prénom' . $i);
            $teacher->setStartYear(mt_rand(2010, 2020));

            $this->setLesson($promotion, $teacher, $manager);

            $manager->persist($teacher);
        }

        $manager->flush();
    }



    private function setStudent(Promotion $promotion, ObjectManager $manager)
    {

        for ($i = 1; $i <= 100; $i++) {
            $student = new Student;
            $student->setLastName('Nom de famille' . $i);
            $student->setFirstName('Prénom' . $i);
            $student->setAge(mt_rand(18, 25));
            $student->setStartYear(mt_rand(2016, 2020));
            $student->setPromotion($promotion);

            $manager->persist($student);
        }
    }

    private function setLesson(Promotion $promotion, Teacher $teacher, ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; $i++) {
            $lesson = new Lesson;
            $lesson->setName('Lesson n°' . $i);
            $lesson->setStartDate(New \DateTime('06/04/2014'));
            $lesson->setEndDate(New \DateTime('06/04/2014'));
            $lesson->setTeacher($teacher);
            $lesson->setPromotion($promotion);

            $manager->persist($lesson);
        }
    }

    /*private function setMark(Lesson $lesson, Student $student, ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; $i++) {
            $mark = new Mark;
            $mark->setValue(mt_rand(0, 20));
            $mark->setLesson($lesson);
            $mark->setStudent($student);

            $manager->persist($mark);
        }
    }*/

}
