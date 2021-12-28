<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentDetailController extends AbstractController
{
    /**
     * @Route("/student/detail", name="student_detail")
     */
    public function index(): Response
    {
        return $this->render('student_detail/index.html.twig', [
            'controller_name' => 'StudentDetailController',
        ]);
    }
}
