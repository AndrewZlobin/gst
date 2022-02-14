<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Service\BlocksForOurTeamPage;

class OurTeamController extends AbstractController
{
    const IDENTIFIER = 'our_team';
    const WRAPPER_CLASS = 'bg-custom-dark';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/our_team", name="our_team")
     */
    public function index(BlocksForOurTeamPage $blocks): Response
    {
        $page = self::IDENTIFIER;

        $navbar = $blocks->getNavbar();
        $footer = $blocks->getFooter();

        return $this->render('our_team/index.html.twig', [
            'pagetitle' => $this->translator->trans("pages.${page}"),
            'extracontainerclasses' => self::WRAPPER_CLASS,
            $navbar->getIdentifier() => $navbar->getNavbar(),
            $footer->getIdentifier() => $footer->getFooter([
                'footercontainer' => $this->translator->trans("pages.${page}"),
                'extracontainerclasses' => 'bg-transparent'
            ]),
        ]);
    }
}
