<?php


namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class NavbarWithBannerGenerator
{
    const IDENTIFIER = 'navbar';
    const WRAPPER_CLASS = 'navbar-banner';

    private NavbarGenerator $navbar;
    private TranslatorInterface $translator;
    private UrlGeneratorInterface $router;

    public function __construct(NavbarGenerator $navbar,
                                TranslatorInterface $translator,
                                UrlGeneratorInterface $router)
    {
        $this->navbar = $navbar;
        $this->translator = $translator;
        $this->router = $router;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
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
            'button' => $this->translator->trans('navbar.button'),
            'link' => $this->router->generate($this->navbar::ABOUT_US),
        ];
    }
}
