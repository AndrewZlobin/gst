<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Service\BlocksForMainActivitiesPage;

class MainActivitiesController extends AbstractController
{
    const IDENTIFIER = 'main_activities';
    const WRAPPER_CLASS = 'bg-custom-dark';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/main_activities", name="main_activities")
     */
    public function index(BlocksForMainActivitiesPage $blocks): Response
    {
        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $footer = $blocks->getFooter();

        return $this->render('main_activities/index.html.twig', [
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbar(),
            $footer->getIdentifier() => $footer->getFooter($blocks->getData())
        ]);
    }

    /**
     * @Route("/activities/{id}", name="view_activity")
     */
    public function view(int $id, BlocksForMainActivitiesPage $blocks): Response
    {
        $navbar = $blocks->getNavbar();
        $footer = $blocks->getFooter();

        return $this->render('main_activities/view.html.twig', [
            'pagetitle' => 'construction_and_installation',
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbar(),
            $footer->getIdentifier() => $footer->getFooter($blocks->getActivityData($id))
        ]);
    }
}
