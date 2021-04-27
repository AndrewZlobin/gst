<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class NavbarWithBannerGenerator
{
    const WRAPPER_CLASS = 'navbar-banner';

    private NavbarGenerator $navbar;
    private TranslatorInterface $translator;

    public function __construct(NavbarGenerator $navbar, TranslatorInterface $translator)
    {
        $this->navbar = $navbar;
        $this->translator = $translator;
    }

    public function getNavbarWithBanner(): array
    {
        $navbar = $this->navbar->getNavbar();
        $navbar['banner'] = $this->getBannerData();
        $navbar['extracontainerclasses'] = self::WRAPPER_CLASS;

        return $navbar;
    }

    protected function getBannerData(): array
    {
        return [
            'header' => $this->translator->trans('navbar.header'),
            'caption' => $this->translator->trans('navbar.caption'),
        ];
    }
}
