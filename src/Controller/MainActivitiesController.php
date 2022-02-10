<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Service\BlocksForActivitiesPage;

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
    public function index(BlocksForActivitiesPage $blocks): Response
    {
//        construction_and_installation
//        design_and_survey
//        complex_supplies
//        construction_equipment_rental

        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $footer = $blocks->getFooter();

        return $this->render('main_activities/index.html.twig', [
            $navbar->getIdentifier() => $navbar->getNavbar(),
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $footer->getIdentifier() => $footer->getFooter([
                'footercontainer' => $this->translator->trans("pages.${page}"),
                'extracontainerclasses' => 'bg-transparent'
            ]),
        ]);
    }
}
