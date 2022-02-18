<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ConstructionEquipmentRentalGenerator extends BaseMainActivityGenerator
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->setType('construction_equipment_rental');

        parent::__construct($router);
    }
}