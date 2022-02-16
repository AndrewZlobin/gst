<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlocksForMainActivitiesPage
{
    const CONSTRUCTION_AND_INSTALLATION = 'construction_and_installation';
    const DESIGN_AND_SURVEY = 'design_and_survey';
    const COMPLEX_SUPPLIES = 'complex_supplies';
    const CONSTRUCTION_EQUIPMENT_RENTAL = 'construction_equipment_rental';

    private TranslatorInterface $translator;
    private UrlGeneratorInterface $router;

    private NavbarGenerator $navbar;
    private FooterWithBlockGenerator $footerwithblockgenerator;

    public function __construct(TranslatorInterface $translator,
                                UrlGeneratorInterface $router,
                                NavbarGenerator $navbar,
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
            'header' => 'Основные виды деятельности',
            'activities' => $this->getActivities(),
        ];
    }

    private function getActivities(): array
    {
        $activities = [
            self::CONSTRUCTION_AND_INSTALLATION => [],
            self::DESIGN_AND_SURVEY => [],
            self::COMPLEX_SUPPLIES => [],
            self::CONSTRUCTION_EQUIPMENT_RENTAL => []
        ];

        foreach ($activities as $key => $data) {
            $activities[$key] = [
                'header' => $this->getActivityHeader($key),
                'description' => $this->getActivityDescription($key),
                'route' => $this->getActivityRoute($key)
            ];
        }

        return $activities;
    }

    private function getActivityHeader(string $key): string
    {
        $headers = [
            self::CONSTRUCTION_AND_INSTALLATION => 'Строительно-монтажные работы',
            self::DESIGN_AND_SURVEY => 'Проектно-изыскательные работы',
            self::COMPLEX_SUPPLIES => 'Комплексные поставки материально-технических ресурсов',
            self::CONSTRUCTION_EQUIPMENT_RENTAL => 'Аренда строительно техники',
        ];

        return $headers[$key];
    }

    private function getActivityDescription(string $key): string
    {
        $descriptions = [
            self::CONSTRUCTION_AND_INSTALLATION => 'Весь спектр услуг от строительства «с нуля» и капитального ремонта зданий и сооружений «под ключ» до диагностического обслуживания и устранения неполадок в работе систем.',
            self::DESIGN_AND_SURVEY => 'Весь комплекс работ по проведению инженерных изысканий, разработке технико-экономических обоснований строительства, подготовке проектов и документации.',
            self::COMPLEX_SUPPLIES => 'Широкий ассортимент материалов и оборудования для возведения промышленного объекта — от металлопроката до кабельной продукции и отделочных материалов.',
            self::CONSTRUCTION_EQUIPMENT_RENTAL => 'Собственный парк строительной техники, автотранспорта, специализированное оборудование для сварочных работ и доставка арендованной техники заказчику в любой регион оптимальным путем.',
        ];

        return $descriptions[$key];
    }

    private function getActivityRoute(string $key): string
    {
        return $this->router->generate($key);
    }
}