<?php

namespace App\Controller;

use App\Entity\SubjectCategory;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectCategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="category_index")
     */
    public function categoryIndex(){
        $categories = $this->getDoctrine()->getRepository(SubjectCategory::class)->findAll();
        return $this->render("subject_category/index.html.twig", [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/detail/{id}", name="category_detail")
     */
    public function categoryDetail($id){
        $cate = $this->getDoctrine()->getRepository(SubjectCategory::class)->find($id);
        return $this->render("subject_category/detail.html.twig", [
            'category' => $cate
        ]);
    }

    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function categoryDelete($id){
        $cate = $this->getDoctrine()->getRepository(SubjectCategory::class)->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($cate);
        $manager->flush();
        
        return $this->redirectToRoute("category_index");
    }

    /**
     * @Route("/category/add", name="category_add")
     */
    public function categoryAdd(Request $request){
        $cate = new SubjectCategory();
        $form = $this->createForm(CategoryType::class, $cate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cate);
            $manager->flush();
            return $this->redirectToRoute("category_index");
        }

        return $this->renderForm("/subject_category/add.html.twig", [
            'form' => $form
        ]);
    }

    /**
     * @Route("/category/edit/{id}", name="category_edit")
     */
    public function categoryEdit(Request $request, $id){
        $cate = $this->getDoctrine()->getRepository(SubjectCategory::class)->find($id);
        $form = $this->createForm(CategoryType::class, $cate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cate);
            $manager->flush();
            return $this->redirectToRoute("category_index");
        }

        return $this->renderForm("/subject_category/edit.html.twig", [
            'form' => $form
        ]);
    }
}
