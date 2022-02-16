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
//        construction_and_installation
//        design_and_survey
//        complex_supplies
//        construction_equipment_rental

        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $footer = $blocks->getFooter();
        $activitiesList = $blocks->getData();

        return $this->render('main_activities/index.html.twig', [
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbar(),
            $footer->getIdentifier() => $footer->getFooter([
                'footercontainer' => $this->translator->trans("pages.${page}"),
                'extracontainerclasses' => 'bg-transparent'
            ]),
            'activitieslist' => $activitiesList,
        ]);
    }

    /**
     * @Route("/main_activities/construction_and_installation", name="construction_and_installation")
     */
    public function constructionandinstallation() {}

    /**
     * @Route("/main_activities/design_and_survey", name="design_and_survey")
     */
    public function designandsurvey() {}

    /**
     * @Route("/main_activities/complex_supplies", name="complex_supplies")
     */
    public function complexsupplies() {}

    /**
     * @Route("/main_activities/construction_equipment_rental", name="construction_equipment_rental")
     */
    public function constructionequipmentrental() {}
}
