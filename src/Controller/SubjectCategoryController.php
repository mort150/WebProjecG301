<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectCategoryController extends AbstractController
{
    #[Route('/subject/category', name: 'subject_category')]
    public function index(): Response
    {
        return $this->render('subject_category/index.html.twig', [
            'controller_name' => 'SubjectCategoryController',
        ]);
    }
}
