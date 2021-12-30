<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom_index")
     */
    public function classroomIndex()
    {
        $classrooms = $this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render(
            'classroom/index.html.twig',
            [
                'classrooms' => $classrooms
            ]
        );
    }

    /**
     * @Route("/classroom/detail/{id}", name="classroom_detail")
     */
    public function classroomDetail($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        return $this->render(
            'classroom/detail.html.twig',
            [
                'classroom' => $classroom
            ]
        );
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/classroom/delete/{id}", name="classroom_delete")
     */
    public function classroomDelete($id)
    {
        $classrooms = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($classrooms);
        $manager->flush();
        return $this->redirectToRoute('classroom_index');
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/classroom/add", name="classroom_add")
     */
    public function classroomAdd(Request $request)
    {
        $classroom = new classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($classroom);
            $manager->flush();
            return $this->redirectToRoute('classroom_index');
        }
            
        return $this->renderForm('classroom/add.html.twig', [
            'form' => $form
        ]);
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/classroom/edit/{id}", name="classroom_edit")
     */
    public function classroomEdit(Request $request, $id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($classroom);
            $manager->flush();
            return $this->redirectToRoute('classroom_index');
        }
            
        return $this->renderForm('classroom/edit.html.twig', [
            'form' => $form
        ]);
    }

    // /**
    //  * @Route("/classroom/search", name="classroom_name_search")
    //  */
    // public function classroomSearch(ClassroomRepository $repository, Request $request)
    // {
    //     $name = $request->get("name");
    //     $classrooms = $repository->searchclassroom($name);
    //     return $this->render("classroom/index.html.twig",[
    //         'classrooms' => $classrooms
    //     ]);
    // }
    
}
