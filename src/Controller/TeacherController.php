<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\throwException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="teacher_index")
     */
    public function teacherIndex()
    {
        $teachers = $this->getDoctrine()->getRepository(Teacher::class)->findAll();
        return $this->render(
            'teacher/index.html.twig',
            [
                'teachers' => $teachers
            ]
        );
    }

    /**
     * @Route("/teacher/detail/{id}", name="teacher_detail")
     */
    public function teacherDetail($id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        return $this->render(
            'teacher/detail.html.twig',
            [
                'teacher' => $teacher
            ]
        );
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/teacher/delete/{id}", name="teacher_delete")
     */
    public function teacherDelete($id)
    {
        $teachers = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($teachers);
        $manager->flush();
        return $this->redirectToRoute('teacher_index');
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/teacher/add", name="teacher_add")
     */
    public function teacherAdd(Request $request)
    {

        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $teacher->getImage();
            $iname = uniqid();
            $iExtension = $image->guessExtension();
            $idonename = $iname . "." . $iExtension;
            try {
                $image->move(
                    $this->getParameter('teacher_image'),
                    $idonename
                );
            } catch (FileException $i) {
                throwException($i);
            }
            $teacher->setImage($idonename);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/add.html.twig', [
            'form' => $form
        ]);
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/teacher/edit/{id}", name="teacher_edit")
     */
    public function teacherEdit(Request $request, $id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            if ($file != null) {
                $image = $teacher->getImage();
                $iname = uniqid();
                $iExtension = $image->guessExtension();
                $idonename = $iname . "." . $iExtension;
                try {
                    $image->move(
                        $this->getParameter('teacher_image'),
                        $idonename
                    );
                } catch (FileException $i) {
                    throwException($i);
                }
                $teacher->setImage($idonename);
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/edit.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/teacher/search", name="teacher_name_search")
     */
    public function teacherSearch(TeacherRepository $repository, Request $request)
    {
        $name = $request->get("name");
        $teachers = $repository->searchTeacher($name);
        return $this->render("teacher/index.html.twig",[
            'teachers' => $teachers
        ]);
    }

}
