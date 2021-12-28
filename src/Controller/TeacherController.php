<?php
namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'teacher_index')]
    public function teacherIndex() {
        $teachers = $this->getDoctrine()->getRepository(Teacher::class)->findAll();
        return $this->render("teacher/index.html.twig", 
        [
            'teachers' => $teachers
        ]);

    }
    #[Route('/teacher/detail/{id}', name: 'teacher_detail')]
    public function teacherDetail ($id) {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);

        // check lỗi khi người dùng cố tình gõ đường dẫn.
        if ($teacher == null){
            $this ->addFlash("Error","teacher khong ton tai");
            return $this->redirectToRoute("teacher_index");
        }
        return $this->renderForm("teacher/detail.html.twig",
        [
            'teacher' => $teacher 
        ]);

    }

    #[Route('/teacher/delete/{id}', name: 'teacher_delete')]
    public function teacherDelete ($id) {
        $teacher = $this ->getDoctrine()->getRepository(Teacher::class)->find($id);
        if($teacher == null) {
            $this->addFlash("Error","xoa teacher khong thanh cong");
        }else {
            $manager = $this ->getDoctrine()->getManager();
            $manager ->remove($teacher); // remove (là tôi cần xóa cái này)
            $manager ->flush(); // flush dạng dạng kiểu confỉm lại
            $this ->addFlash("Success", "teacher delete Success"); 
        }
        return $this->redirectToRoute('teacher_index');
    }

    #[Route('/teacher/add', name: 'teacher_add')]
    public function teacherAdd(Request $request) {
        $teacher = new Teacher();
        $form = $this ->createForm(TeacherType::class, $teacher);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($teacher);
            $manager ->flush();

            $this->addFlash("Success", "Add teacher success");
            return $this->redirectToRoute("teacher_index");
        }

        return $this->renderForm("teacher/add.html.twig",
        [
            'teacherform' => $form
        ]);
    }

    #[Route('/teacher/edit/{id}', name: 'teacher_edit')]
    public function teacherEdit(Request $request, $id) {
        $teacher = $this -> getDoctrine()->getRepository(teacher::class)->find($id);
        $form = $this ->createForm(TeacherType::class, $teacher);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($teacher);
            $manager ->flush();

            $this->addFlash("Success", "Edit teacher success");
            return $this->redirectToRoute("teacher_index");
        }

        return $this->renderForm("teacher/edit.html.twig",
        [
            'teacherform' => $form
        ]);
    }
}
