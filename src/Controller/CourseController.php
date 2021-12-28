<?php
namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    #[Route('/course', name: 'course_index')]
    public function courseIndex() {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();
        return $this->render("course/index.html.twig", 
        [
            'courses' => $courses
        ]);

    }
    #[Route('/course/detail/{id}', name: 'course_detail')]
    public function courseDetail ($id) {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        // check lỗi khi người dùng cố tình gõ đường dẫn.
        if ($course == null){
            $this ->addFlash("Error","lop khong ton tai");
            return $this->redirectToRoute("course_index");
        }
        return $this->renderForm("course/detail.html.twig",
        [
            'course' => $course 
        ]);

    }

    #[Route('/course/delete/{id}', name: 'course_delete')]
    public function courseDelete ($id) {
        $course = $this ->getDoctrine()->getRepository(Course::class)->find($id);
        if($course == null) {
            $this->addFlash("Error","xoa lop khong thanh cong");
        }else {
            $manager = $this ->getDoctrine()->getManager();
            $manager ->remove($course); // remove (là tôi cần xóa cái này)
            $manager ->flush(); // flush dạng dạng kiểu confỉm lại
            $this ->addFlash("Success", "Course delete Success"); 
        }
        return $this->redirectToRoute('course_index');
    }

    #[Route('/course/add', name: 'course_add')]
    public function courseAdd(Request $request) {
        $course = new Course();
        $form = $this ->createForm(CourseType::class, $course);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($course);
            $manager ->flush();

            $this->addFlash("Success", "Add Course success");
            return $this->redirectToRoute("course_index");
        }

        return $this->renderForm("course/add.html.twig",
        [
            'courseform' => $form
        ]);
    }

    #[Route('/course/edit/{id}', name: 'course_edit')]
    public function courseEdit(Request $request, $id) {
        $course = $this -> getDoctrine()->getRepository(Course::class)->find($id);
        $form = $this ->createForm(CourseType::class, $course);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager =$this ->getDoctrine()->getManager();
            $manager ->persist($course);
            $manager ->flush();

            $this->addFlash("Success", "Edit Course success");
            return $this->redirectToRoute("course_index");
        }

        return $this->renderForm("course/edit.html.twig",
        [
            'courseform' => $form
        ]);
    }
}
