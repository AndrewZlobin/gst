<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ComplexSuppliesGenerator extends BaseMainActivityGenerator
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this
            ->setId(3)
            ->setType('complex_supplies')
            ->setData([
                'logisticAdvantages' => $this->getLogisticAdvantages(),
            ]);

        parent::__construct($router);
    }

    private function getLogisticAdvantages(): array
    {
        return [
            'Своевременные поставки — важная составляющая любого строительного проекта. Установление долгосрочных партнерских отношений с заводами-изготовителями строительных материалов и оборудования позволяет ООО «Газстройтех» гарантировать поставку строго в установленные заказчиком сроки.',
            'Немалую роль играют и грамотно выстроенные логистические цепочки: для доставки стройматериалов и специализированного оборудования используются железнодорожные, автомобильные, воздушные и морские пути.'
        ];
    }
}