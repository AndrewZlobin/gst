<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class NavbarGenerator
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
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
            $this->translator->trans('navbar.links.aboutus'),
            $this->translator->trans('navbar.links.activities'),
            $this->translator->trans('navbar.links.projects'),
            $this->translator->trans('navbar.links.career'),
            $this->translator->trans('navbar.links.contacts'),
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
