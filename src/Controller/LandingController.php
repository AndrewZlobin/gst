<?php

namespace App\Controller;

use App\Service\BlocksForLandingPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    const WRAPPER_CLASS = 'bg-custom-dark';

    /**
     * @Route("/", name="landing")
     */
    public function index(BlocksForLandingPage $blocks): Response
    {
        $navbar = $blocks->getNavbar();
        $advantages = $blocks->getAdvantages();
        $map = $blocks->getMap();

        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbarWithBanner(),
            $advantages->getIdentifier() => $advantages->getAdvantagesBlocks(),
            $map->getIdentifier() => $map->getOfficesForMap(),
        ]);
    }
}
