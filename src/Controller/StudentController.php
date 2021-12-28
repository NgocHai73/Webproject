<?php
namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'student_index')]
    public function courseIndex() {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render("student/index.html.twig", 
        [
            'students' => $students
        ]);

    }
    #[Route('/student/detail/{id}', name: 'student_detail')]
    public function studentDetail ($id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);

        // check lỗi khi người dùng cố tình gõ đường dẫn.
        if ($student == null){
            $this ->addFlash("Error","student khong ton tai");
            return $this->redirectToRoute("student_index");
        }
        return $this->renderForm("student/detail.html.twig",
        [
            'student' => $student 
        ]);

    }

    #[Route('/student/delete/{id}', name: 'student_delete')]
    public function studentDelete ($id) {
        $student = $this ->getDoctrine()->getRepository(student::class)->find($id);
        if($student == null) {
            $this->addFlash("Error","xoa student khong thanh cong");
        }else {
            $manager = $this ->getDoctrine()->getManager();
            $manager ->remove($student); // remove (là tôi cần xóa cái này)
            $manager ->flush(); // flush dạng dạng kiểu confỉm lại
            $this ->addFlash("Success", "student delete Success"); 
        }
        return $this->redirectToRoute('student_index');
    }

    #[Route('/student/add', name: 'student_add')]
    public function studentAdd(Request $request) {
        $student = new Student();
        $form = $this ->createForm(StudentType::class, $student);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($student);
            $manager ->flush();

            $this->addFlash("Success", "Add student success");
            return $this->redirectToRoute("student_index");
        }

        return $this->renderForm("student/add.html.twig",
        [
            'studentform' => $form
        ]);
    }

    #[Route('/student/edit/{id}', name: 'student_edit')]
    public function studentEdit(Request $request, $id) {
        $student = $this -> getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this ->createForm(StudentType::class, $student);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($student);
            $manager ->flush();

            $this->addFlash("Success", "Edit student success");
            return $this->redirectToRoute("student_index");
        }

        return $this->renderForm("student/edit.html.twig",
        [
            'studentform' => $form
        ]);
    }
}
