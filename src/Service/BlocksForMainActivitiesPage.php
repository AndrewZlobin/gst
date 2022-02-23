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
            ->setHeader('Строительно-монтажные работы')
            ->setDescription('Весь спектр услуг от строительства «с нуля» и капитального ремонта зданий и сооружений «под ключ» до диагностического обслуживания и устранения неполадок в работе систем.');

        $designAndSurvey = (new DesignAndSurveyGenerator($this->router))
            ->setHeader('Проектно-изыскательные работы')
            ->setDescription('Весь комплекс работ по проведению инженерных изысканий, разработке технико-экономических обоснований строительства, подготовке проектов и документации.');

        $complexSupplies = (new ComplexSuppliesGenerator($this->router))
            ->setHeader('Комплексные поставки материально-технических ресурсов')
            ->setDescription('Широкий ассортимент материалов и оборудования для возведения промышленного объекта — от металлопроката до кабельной продукции и отделочных материалов.');

        $constructionEquipmentRental = (new ConstructionEquipmentRentalGenerator($this->router))
            ->setHeader('Аренда строительной техники')
            ->setDescription('Собственный парк строительной техники, автотранспорта, специализированное оборудование для сварочных работ и доставка арендованной техники заказчику в любой регион оптимальным путем.');

        return [
            $constructionsAndInstallations->getId() => $constructionsAndInstallations->generate(),
            $designAndSurvey->getId() => $designAndSurvey->generate(),
            $complexSupplies->getId() => $complexSupplies->generate(),
            $constructionEquipmentRental->getId() => $constructionEquipmentRental->generate()
        ];
    }
}