<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainActivitiesController extends AbstractController
{
    /**
     * @Route("/main_activities/{type}", name="main_activities")
     */
    public function index(string $type): Response
    {
//        construction_and_installation
//        design_and_survey
//        complex_supplies
//        construction_equipment_rental
        return $this->render('main_activities/index.html.twig', [
            'controller_name' => 'MainActivitiesController',
        ]);
    }
}
