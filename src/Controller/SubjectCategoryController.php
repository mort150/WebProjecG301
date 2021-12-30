<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Entity\SubjectCategory;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use function PHPUnit\Framework\throwException;

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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
     * @Route("/category/add", name="category_add")
     */
    public function categoryAdd(Request $request){
        $cate = new SubjectCategory();
        $form = $this->createForm(CategoryType::class, $cate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //upload image
            $image = $cate->getCover();
            $imgName = uniqid();
            // $imgExtension = $image->guessExtension();
            $imgNew = $imgName . ".png";

            try{
                $image->move(
                    $this->getParameter('major_cover'), $imgNew
                );
            }catch(FileException $e){
                throwException($e);
            }
            $cate->setCover($imgNew);
            
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
     * @IsGranted("ROLE_ADMIN")
     * @Route("/category/edit/{id}", name="category_edit")
     */
    public function categoryEdit(Request $request, $id){
        $cate = $this->getDoctrine()->getRepository(SubjectCategory::class)->find($id);
        $form = $this->createForm(CategoryType::class, $cate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //upload image
            $file = $form['cover']->getData();
            if($file != null){
                $image = $cate->getCover();
                $imgName = uniqid();
                // $imgExtension = $image->guessExtension();
                $imgNew = $imgName . ".png";

                try{
                    $image->move(
                        $this->getParameter('major_cover'), $imgNew
                    );
                }catch(FileException $e){
                    throwException($e);
                }
                $cate->setCover($imgNew);
            }
            
            
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
