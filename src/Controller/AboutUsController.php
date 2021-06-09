<?php

namespace App\Controller;

use App\Service\BlocksForAboutUsPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AboutUsController extends AbstractController
{
    const IDENTIFIER = 'about_us';
    const WRAPPER_CLASS = 'bg-custom-dark';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/about_us", name="about_us")
     */
    public function index(BlocksForAboutUsPage $blocks): Response
    {
        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $subheader = $blocks->getSubheader();
        $companyreference = $blocks->getCompanyreference();
        $map = $blocks->getMap();

        return $this->render('about_us/index.html.twig', [
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbar(),
            $subheader->getIdentifier() => $subheader->getSubHeader($page),
            $companyreference->getIdentifier() => $companyreference->getReference(),
            $map->getIdentifier() => $map->getOfficesForMap(),
        ]);
    }
}
