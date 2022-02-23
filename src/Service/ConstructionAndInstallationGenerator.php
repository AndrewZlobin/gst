<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ConstructionAndInstallationGenerator extends BaseMainActivityGenerator
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this
            ->setId(1)
            ->setType('construction_and_installations')
            ->setData([
                'workTypes' => $this->getMainWorkTypes(),
                'images' => $this->getImages(),
            ]);

        parent::__construct($router);
    }

    private function getMainWorkTypes(): array
    {
        return [
            'выполнение общестроительных работ;',
            'прокладка электрических и кабельных линий;',
            'прокладка линий связи методом подвески;',
            'монтаж, ремонт и техническое обслуживание специальных сооружений (мачты, башни радиосвязи, радио- и телевещания);',
            'монтаж радиорелейного оборудования (Nec, Nera, Ericsson и др.);',
            'монтаж систем УКВ радиосвязи;',
            'монтаж линейных и станционных сооружений проводной связи (местной, внутризоновой, междугородной), включая ВОЛС;',
            'монтаж оборудования спутниковой связи;',
            'монтаж оборудования широкополосного доступа;',
            'монтаж оборудования видеомониторинга.',
        ];
    }

    private function getImages(): array
    {
        $images = [];

        for ($i = 1; $i <= 3; $i++) {
            $images[] = [
                'name' => 'constructionandinstallation-' . $i,
                'extension' => 'jpg'
            ];
        }

        return $images;
    }
}