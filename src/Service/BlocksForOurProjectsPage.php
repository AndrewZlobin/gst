<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class BlocksForOurProjectsPage
{
    private TranslatorInterface $translator;
    private NavbarGenerator $navbar;
    private FooterWithBlockGenerator $footerwithblockgenerator;

    public function __construct(TranslatorInterface $translator,
                                NavbarGenerator $navbar,
                                FooterWithBlockGenerator $footerwithblockgenerator
                                )
    {
        $this->translator = $translator;
        $this->navbar = $navbar;
        $this->footerwithblockgenerator = $footerwithblockgenerator;
    }

    /**
     * @return NavbarGenerator
     */
    public function getNavbar(): NavbarGenerator
    {
        return $this->navbar;
    }

    public function getFooter()
    {
        return $this->footerwithblockgenerator;
    }
}