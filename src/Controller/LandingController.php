<?php

namespace App\Controller;

use App\Form\ContactUsType;
use App\Service\BlocksForLandingPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class LandingController extends AbstractController
{
    const IDENTIFIER = 'landing';
    const WRAPPER_CLASS = 'bg-custom-dark';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="landing")
     */
    public function index(BlocksForLandingPage $blocks, Request $request): Response
    {
        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $advantages = $blocks->getAdvantages();
        $map = $blocks->getMap();
        $footer = $blocks->getFooterWithFormGenerator($page);
        $activities = $blocks->getActivities();

        return $this->render('landing/index.html.twig', [
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbarWithBanner(),
            $advantages->getIdentifier() => $advantages->getAdvantagesBlocks(),
            $map->getIdentifier() => $map->getOfficesForMap(),
            $footer->getIdentifier() => $footer->getFooterWithForm($activities->getActivities(), $page),
        ]);
    }
}
