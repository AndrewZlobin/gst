<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DesignAndSurveyGenerator extends BaseMainActivityGenerator
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->setType('design_and_survey');

        parent::__construct($router);
    }
}