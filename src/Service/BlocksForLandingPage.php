<?php


namespace App\Service;


class BlocksForLandingPage
{
    private NavbarWithBannerGenerator $navbar;
    private AdvantagesGenerator $advantages;
    private MapGenerator $map;
    private FooterWithBlockGenerator $footer;
    private ActivitiesGenerator $activities;

    public function __construct(NavbarWithBannerGenerator $navbar,
                                AdvantagesGenerator $advantages,
                                MapGenerator $map,
                                FooterWithBlockGenerator $footer,
                                ActivitiesGenerator $activities)
    {
        $this->navbar = $navbar;
        $this->advantages = $advantages;
        $this->map = $map;
        $this->footer = $footer;
        $this->activities = $activities;
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

    /**
     * @return FooterWithBlockGenerator
     */
    public function getFooter(): FooterWithBlockGenerator
    {
        return $this->footer;
    }

    /**
     * @return ActivitiesGenerator
     */
    public function getActivities(): ActivitiesGenerator
    {
        return $this->activities;
    }
}
