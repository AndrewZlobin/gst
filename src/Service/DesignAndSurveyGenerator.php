<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DesignAndSurveyGenerator extends BaseMainActivityGenerator
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this
            ->setId(2)
            ->setType('design_and_survey')
            ->setData([
                'complexServices' => $this->getComplexServices(),
                'ourCustomers' => $this->getOurCustomers(),
            ]);

        parent::__construct($router);
    }

    private function getComplexServices(): array
    {
        return [
            'Инженерные изыскания (геодезические, геологические, гидрологические, геофизические, экологические, гидрометеорологические и др.);',
            'Выезд на объект, определение границ работ, сбор исходных данных, ТУ, согласование в надлежащих органах.',
            'Разработка технико-экономических обоснований строительства, основных технических решений.',
            'Полное сопровождение проекта на всех стадиях экспертизы до её успешного прохождения.',
            'Разработка сметной документации.'
        ];
    }

    private function getOurCustomers(): array
    {
        $customers = [];

        for ($i = 1; $i <= 12; $i++) {
            $customers[] = [
                'name' => 'customer-' . $i,
                'ext' => 'png'
            ];
        }

        return $customers;
    }
}