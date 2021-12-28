<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeStudentController extends AbstractController
{
    /**
     * @Route("/homeStudent", name="home_student")
     */
    public function index(): Response
    {
        return $this->render('home_student/index.html.twig', [
            'controller_name' => 'HomeStudentController',
        ]);
    }
}
