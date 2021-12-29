<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use function PHPUnit\Framework\throwException;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class StudentController extends AbstractController
{
    /**
     * @Route("/students", name="student_index")
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
    public function studentDelete($id){
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($student);
        $manager->flush();

        return $this->redirectToRoute("student_index");
    }

    /**
     * @Route("/student/add/", name="student_add")
     */
    public function studentAdd(Request $request){
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form ->handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()){
                $image = $student->getImage();
                $imgName = uniqid();
                $imgExtension = $image->guessExtension();
                $imageName = $imgName . '.' . $imgExtension;
                try{
                    $image->move(
                        $this->getParameter('student_image'), $imageName
                    );
                }catch(FileException $e){
                    throwException($e);
                }
            $manager = $this->getDoctrine()->getManager();
            $manager ->persist($student);
            $manager->flush();
            return $this->redirectToRoute("student_index");
        }

        return $this->renderForm("student/add.html.twig",[
            'form' => $form
        ]);
    }

    /**
     * @Route("/student/edit/{id}", name="student_edit")
     */
    public function studentEdit(Request $request, $id){
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form ->handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()){
            $file = $form['image']->getData();
            if ($file != null){
                $image = $student->getImage();
                $imgName = uniqid();
                $imgExtension = $image->guessExtension();
                $imageName = $imgName . '.' . $imgExtension;
                try{
                    $image->move(
                        $this->getParameter('student_image'), $imageName
                    );
                }catch(FileException $e){
                    throwException($e);
                }
            }
            $student->setImage($imageName);
            $manager = $this->getDoctrine()->getManager();
            $manager ->persist($student);
            $manager->flush();
            return $this->redirectToRoute("student_index");
        }

        return $this->renderForm("student/edit.html.twig",[
            'form' => $form
        ]);
    }
}
