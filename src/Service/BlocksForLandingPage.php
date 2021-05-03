<?php


namespace App\Service;


class BlocksForLandingPage
{
    private NavbarWithBannerGenerator $navbar;
    private AdvantagesGenerator $advantages;
    private MapGenerator $map;

    public function __construct(NavbarWithBannerGenerator $navbar, AdvantagesGenerator $advantages, MapGenerator $map)
    {
        $this->navbar = $navbar;
        $this->advantages = $advantages;
        $this->map = $map;
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

    /**
     * @return MapGenerator
     */
    public function getMap(): MapGenerator
    {
        return $this->map;
    }


}
