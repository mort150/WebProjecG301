<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubjectController extends AbstractController
{
    /**
     * @Route("/subjects", name="subject_index")
     */
    public function subjectIndex(){
        $subjects = $this->getDoctrine()->getRepository(Subject::class)->findAll();
        return $this->render("subject/index.html.twig", [
            'subjects' => $subjects
        ]);
    }

    /**
     * @Route("/subject/detail/{id}", name="subject_detail")
     */
    public function subjectDetail($id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        return $this->render("subject/detail.html.twig", [
            'subject' => $subject
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/subject/delete/{id}", name="subject_delete")
     */
    public function subjectDelete($id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($subject);
        $manager->flush();

        return $this->redirectToRoute("subject_index");
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/subject/add", name="subject_add")
     */
    public function subjectAdd(Request $request){
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute("subject_index");
        }

        return $this->renderForm("subject/add.html.twig", [
            'form' => $form
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/subject/edit/{id}", name="subject_edit")
     */
    public function subjectEdit(Request $request, $id){
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute("subject_index");
        }

        return $this->renderForm("subject/edit.html.twig", [
            'form' => $form
        ]);
    }
}
