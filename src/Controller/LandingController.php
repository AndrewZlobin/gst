<?php

namespace App\Controller;

use App\Service\NavbarGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    /**
     * @Route("/", name="landing")
     */
    public function index(NavbarGenerator $navbarGenerator): Response
    {
        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'navbar' => $navbarGenerator->getNavbar()
        ]);
    }
}
