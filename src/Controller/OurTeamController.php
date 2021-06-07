<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OurTeamController extends AbstractController
{
    /**
     * @Route("/our_team", name="our_team")
     */
    public function index(): Response
    {
        return $this->render('our_team/index.html.twig', [
            'controller_name' => 'OurTeamController',
        ]);
    }
}
