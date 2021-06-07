<?php


namespace App\Service;


use App\Controller\ContactUsController;

class BlocksForAboutUsPage
{
    private NavbarGenerator $navbar;

    public function __construct(NavbarGenerator $navbar)
    {
        $this->navbar = $navbar;
    }

    /**
     * @return NavbarGenerator
     */
    public function getNavbar(): NavbarGenerator
    {
        return $this->navbar;
    }

}
