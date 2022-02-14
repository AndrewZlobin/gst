<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NavbarGenerator
{
    const IDENTIFIER = 'navbar';
    const WRAPPER_CLASS = 'navbar-banner';

    const LANDING = 'landing';
    const ABOUT_US = 'about_us';
    const MAIN_ACTIVITIES = 'main_activities';
    const CONSTRUCTION_AND_INSTALLATION = 'construction_and_installation';
    const DESIGN_AND_SURVEY = 'design_and_survey';
    const COMPLEX_SUPPLIES = 'complex_supplies';
    const CONSTRUCTION_EQUIPMENT_RENTAL = 'construction_equipment_rental';
    const OUR_PROJECTS = 'our_projects';
    const OUR_TEAM = 'our_team';
    const CONTACTS = 'contacts';

    private TranslatorInterface $translator;
    private UrlGeneratorInterface $router;

    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $router)
    {
        $this->translator = $translator;
        $this->router = $router;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getNavbar(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'header' => $this->getNavbarHeader(),
            'links' => $this->getTranslatedNavbarLinks()
        ];
    }

    protected function getTranslatedNavbarLinks(): array
    {
        $referencetype = UrlGeneratorInterface::ABSOLUTE_URL;

        return [
            [
                'title' => $this->translator->trans('navbar.links.' . self::LANDING),
                'href' => $this->router->generate(self::LANDING, [], $referencetype),
                'renderinlogo' => true
            ],
            [
                'title' => $this->translator->trans('navbar.links.aboutus'),
                'route' => self::ABOUT_US,
                'href' => $this->router->generate(self::ABOUT_US, [], $referencetype),
            ],
            [
                'title' => $this->translator->trans('navbar.links.activities'),
                'route' => self::MAIN_ACTIVITIES,
                'href' => $this->router->generate(self::MAIN_ACTIVITIES, [], $referencetype),
            ],
            [
                'title' => $this->translator->trans('navbar.links.projects'),
                'route' => self::OUR_PROJECTS,
                'href' => $this->router->generate(self::OUR_PROJECTS, [], $referencetype),
            ],
            [
                'title' => $this->translator->trans('navbar.links.career'),
                'route' => self::OUR_TEAM,
                'href' => $this->router->generate(self::OUR_TEAM, [], $referencetype),
            ],
            [
                'title' => $this->translator->trans('navbar.links.contacts'),
                'route' => self::CONTACTS,
                'href' => $this->router->generate(self::CONTACTS, [], $referencetype),
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

    public function getMainActivitiesSubLinks(): array
    {
        $defaultsublinsk = [
            self::CONSTRUCTION_AND_INSTALLATION,
            self::DESIGN_AND_SURVEY,
            self::COMPLEX_SUPPLIES,
            self::CONSTRUCTION_EQUIPMENT_RENTAL,
        ];

        $sublinks = [];

        foreach ($defaultsublinsk as $sublink) {
            $sublinks[str_replace("_", " ", $sublink)] = $this->router->generate(
                self::MAIN_ACTIVITIES,
                [
                    'type' => $sublink
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
        }

        return $sublinks;
    }
}
