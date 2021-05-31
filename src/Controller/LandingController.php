<?php

namespace App\Controller;

use App\Form\ContactUsType;
use App\Service\BlocksForLandingPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    const WRAPPER_CLASS = 'bg-custom-dark';

    /**
     * @Route("/", name="landing")
     */
    public function index(BlocksForLandingPage $blocks, Request $request): Response
    {
        $navbar = $blocks->getNavbar();
        $advantages = $blocks->getAdvantages();
        $map = $blocks->getMap();
        $footer = $blocks->getFooterWithFormGenerator();
        $activities = $blocks->getActivities();

        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbarWithBanner(),
            $advantages->getIdentifier() => $advantages->getAdvantagesBlocks(),
            $map->getIdentifier() => $map->getOfficesForMap(),
            $footer->getIdentifier() => $footer->getFooterWithForm($activities->getActivities()),
        ]);
    }
}
