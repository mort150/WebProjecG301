<?php

namespace App\Controller;

use App\Entity\Subject;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/subject/add", name="subject_add")
     */
    public function subjectAdd(Request $request){

    }

    /**
     * @Route("/subject/edit/{id}", name="subject_edit")
     */
    public function subjectEdit(Request $request, $id){
        
    }
}
