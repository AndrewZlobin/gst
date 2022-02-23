<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlocksForMainActivitiesPage
{
    const WRAPPER_CLASS = 'bg-transparent';

    private TranslatorInterface $translator;
    private UrlGeneratorInterface $router;

    private NavbarGenerator $navbar;
    private FooterWithBlockGenerator $footer;

    public function __construct(TranslatorInterface      $translator,
                                UrlGeneratorInterface    $router,
                                NavbarGenerator          $navbar,
                                FooterWithBlockGenerator $footerwithblockgenerator
    )
    {
        $this->translator = $translator;
        $this->router = $router;
        $this->navbar = $navbar;
        $this->footer = $footerwithblockgenerator;
    }

    /**
     * @return NavbarGenerator
     */
    public function getNavbar(): NavbarGenerator
    {
        return $this->navbar;
    }

    public function getFooter(): FooterWithBlockGenerator
    {
        return $this->footer;
    }

    public function getData(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'header' => 'Основные виды деятельности',
            'activities' => $this->getActivities(),
        ];
    }

    public function getActivityData(int $id): array
    {
        $activities = $this->getActivityEntities();

        return $activities[$id];
    }

    private function getActivities(): array
    {
        return array_values($this->getActivityEntities());
    }

    /**
     * Imitate query to database
     *
     * @return array
     */
    private function getActivityEntities(): array
    {
        $constructionsAndInstallations = (new ConstructionAndInstallationGenerator($this->router))
            ->setHeader($this->translator->trans('construction_and_installations.header'))
            ->setDescription($this->translator->trans('construction_and_installations.description'));

        $designAndSurvey = (new DesignAndSurveyGenerator($this->router))
            ->setHeader($this->translator->trans('design_and_survey.header'))
            ->setDescription($this->translator->trans('design_and_survey.description'));

        $complexSupplies = (new ComplexSuppliesGenerator($this->router))
            ->setHeader($this->translator->trans('complex_supplies.header'))
            ->setDescription($this->translator->trans('complex_supplies.description'));

        $constructionEquipmentRental = (new ConstructionEquipmentRentalGenerator($this->router))
            ->setHeader($this->translator->trans('construction_equipment_rental.header'))
            ->setDescription($this->translator->trans('construction_equipment_rental.description'));

        return [
            $constructionsAndInstallations->getId() => $constructionsAndInstallations->generate(),
            $designAndSurvey->getId() => $designAndSurvey->generate(),
            $complexSupplies->getId() => $complexSupplies->generate(),
            $constructionEquipmentRental->getId() => $constructionEquipmentRental->generate()
        ];
    }
}