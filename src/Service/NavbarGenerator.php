<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NavbarGenerator
{
    private TranslatorInterface $translator;
    private UrlGeneratorInterface $router;

    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $router)
    {
        $this->translator = $translator;
        $this->router = $router;
    }

    public function getNavbar(): array
    {
        return [
            'header' => $this->getNavbarHeader(),
            'links' => $this->getTranslatedNavbarLinks()
        ];
    }

    protected function getTranslatedNavbarLinks(): array
    {
        return [
            [
                'title' => $this->translator->trans('navbar.links.main'),
                'href' => $this->router->generate('main'),
                'renderinlogo' => true
            ],
            [
                'title' => $this->translator->trans('navbar.links.aboutus'),
                'href' => '#',
            ],
            [
                'title' => $this->translator->trans('navbar.links.activities'),
                'href' => '#',
            ],
            [
                'title' => $this->translator->trans('navbar.links.projects'),
                'href' => '#',
            ],
            [
                'title' => $this->translator->trans('navbar.links.career'),
                'href' => '#',
            ],
            [
                'title' => $this->translator->trans('navbar.links.contacts'),
                'href' => '#',
            ],
        ];
    }

    protected function getNavbarHeader(): array
    {
        return [
            'phone' => $this->translator->trans('navbar.phone'),
            'email' => $this->translator->trans('navbar.email')
        ];
    }
}
