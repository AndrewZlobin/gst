<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class ActivitiesGenerator
{
    const IDENTIFIER = 'activities';
    const WRAPPER_CLASS = 'bg-white block-activities';

    const MORE_DETAILES = 'moredetailes';
    const ACTIVITIES = [
        'construction and installation',
        'design and survey',
        'complex supplies',
        'construction equipment rental',
    ];

    private TranslatorInterface $translator;
    private NavbarGenerator $navbar;

    public function __construct(TranslatorInterface $translator,
                                NavbarGenerator $navbar)
    {
        $this->translator = $translator;
        $this->navbar = $navbar;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getActivities(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'title' => $this->getTitle(),
            'activities' => $this->getActivitiesData(),
            'moredetailes' => $this->getMoreDetailesButton()
        ];
    }

    protected function getTitle(): string
    {
        $translationid = self::IDENTIFIER;

        return $this->translator->trans("${translationid}.title");
    }

    protected function getActivitiesData(): array
    {
        $translationid = self::IDENTIFIER;

        $activities = [];

        foreach (self::ACTIVITIES as $activity) {
            $image = str_replace(' ', '_', $activity);
            $title = $this->translator->trans("${translationid}.${activity}.title");
            $description = $this->translator->trans("${translationid}.${activity}.description");

            $activities[$activity]['image'] = $image;
            $activities[$activity]['title'] = $title;
            $activities[$activity]['description'] = $description;
            $activities[$activity]['link'] = $this->navbar->getMainActivitiesSubLinks()[$activity];
        }

        return $activities;
    }

    protected function getMoreDetailesButton(): string
    {
        $translationid = self::IDENTIFIER;
        $moredetailes = self::MORE_DETAILES;

        return $this->translator->trans("${translationid}.${moredetailes}");
    }
}
