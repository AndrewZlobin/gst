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
    private FooterWithBlockGenerator $footerwithblockgenerator;

    public function __construct(TranslatorInterface      $translator,
                                UrlGeneratorInterface    $router,
                                NavbarGenerator          $navbar,
                                FooterWithBlockGenerator $footerwithblockgenerator
    )
    {
        $this->translator = $translator;
        $this->router = $router;
        $this->navbar = $navbar;
        $this->footerwithblockgenerator = $footerwithblockgenerator;
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
        return $this->footerwithblockgenerator;
    }

    public function getData(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'header' => 'Основные виды деятельности',
            'activities' => $this->getActivities(),
        ];
    }

    public function getActivityData(string $type): array
    {
        switch (true) {
            case $this->constructionAndInstallationActivity()->getType() === $type:
                return $this->constructionAndInstallationActivity()->generateData();
            case $this->designAndSurveyActivity()->getType() === $type:
                return $this->designAndSurveyActivity()->generateData();
            case $this->complexSuppliesActivity()->getType() === $type:
                return $this->complexSuppliesActivity()->generateData();
            case $this->constructionEquipmentRentalActivity()->getType() === $type:
                return $this->constructionEquipmentRentalActivity()->generateData();
            default:
                // In case of error
                return [];
        }
    }

    private function getActivities(): array
    {
        return array_merge(
            $this->constructionAndInstallationActivity()->generateInfo(),
            $this->designAndSurveyActivity()->generateInfo(),
            $this->complexSuppliesActivity()->generateInfo(),
            $this->constructionEquipmentRentalActivity()->generateInfo(),
        );
    }

    private function constructionAndInstallationActivity(): ConstructionAndInstallationGenerator
    {
        $activity = new ConstructionAndInstallationGenerator($this->router);

        return $activity
            ->setHeader('Строительно-монтажные работы')
            ->setDescription('Весь спектр услуг от строительства «с нуля» и капитального ремонта зданий и сооружений «под ключ» до диагностического обслуживания и устранения неполадок в работе систем.')
            ->setData(['data' => 'data']);
    }

    private function designAndSurveyActivity(): DesignAndSurveyGenerator
    {
        $activity = new DesignAndSurveyGenerator($this->router);

        return $activity
            ->setHeader('Проектно-изыскательные работы')
            ->setDescription('Весь комплекс работ по проведению инженерных изысканий, разработке технико-экономических обоснований строительства, подготовке проектов и документации.')
            ->setData(['data' => 'data']);
    }

    private function complexSuppliesActivity(): ComplexSuppliesGenerator
    {
        $activity = new ComplexSuppliesGenerator($this->router);

        return $activity
            ->setHeader('Комплексные поставки материально-технических ресурсов')
            ->setDescription('Широкий ассортимент материалов и оборудования для возведения промышленного объекта — от металлопроката до кабельной продукции и отделочных материалов.')
            ->setData(['data' => 'data']);
    }

    private function constructionEquipmentRentalActivity(): ConstructionEquipmentRentalGenerator
    {
        $activity = new ConstructionEquipmentRentalGenerator($this->router);

        return $activity
            ->setHeader('Аренда строительной техники')
            ->setDescription('Собственный парк строительной техники, автотранспорта, специализированное оборудование для сварочных работ и доставка арендованной техники заказчику в любой регион оптимальным путем.')
            ->setData(['data' => 'data']);
    }
}