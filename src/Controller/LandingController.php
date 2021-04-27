<?php

namespace App\Controller;

use App\Service\NavbarWithBannerGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    const WRAPPER_CLASS = 'bg-custom-dark';

    /**
     * @Route("/", name="landing")
     */
    public function index(NavbarWithBannerGenerator $extendedNavbarGenerator): Response
    {
        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'navbar' => $extendedNavbarGenerator->getNavbarWithBanner()
        ]);
    }
}
