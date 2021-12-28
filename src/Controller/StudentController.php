<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/students", name="student")
     */
    public function index(): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/student/detail/{id}", name="student_detail")
     */
    public function sutdentDetail($id){
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null){
            return $this->redirectToRoute("student_index");
        }
            return $this->render("student/detail.html.twig",
            [
                'student' => $student
            ]);
    }

    /**
     * @Route("/student/delete/{id}", name="student_delete")
     */
    public function sutdentDelete($id){
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student != null)
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
        }
        return $this->redirectToRoute("student_index");
    }

    /**
     * @Route("/student/add/", name="student_add")
     */
    public function studentAdd(Request $request){

    }

    /**
     * @Route("/student/edit/{id}", name="student_edit")
     */
    public function studentEdit(Request $request, $id){
        
    }
}
