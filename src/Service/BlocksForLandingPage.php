<?php


namespace App\Service;


use Symfony\Contracts\Translation\TranslatorInterface;

class BlocksForLandingPage
{
    private NavbarWithBannerGenerator $navbar;
    private AdvantagesGenerator $advantages;

    public function __construct(NavbarWithBannerGenerator $navbar, AdvantagesGenerator $advantages, TranslatorInterface $translator)
    {
        $this->navbar = $navbar;
        $this->advantages = $advantages;
    }

    /**
     * @return NavbarWithBannerGenerator
     */
    public function getNavbar(): NavbarWithBannerGenerator
    {
        return $this->navbar;
    }

    /**
     * @return AdvantagesGenerator
     */
    public function getAdvantages(): AdvantagesGenerator
    {
        return $this->advantages;
    }


}
