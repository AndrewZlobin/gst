<?php

namespace App\Controller;

use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    /**
     * @Route("/contact/us", name="contact_us")
     */
    public function new(string $header, string $caption): Response
    {
        $form = $this->createForm(ContactUsType::class);

        return $this->render('contact_us/form.html.twig', [
            'controller_name' => 'ContactUsController',
            'formheader' => $header,
            'formcaption' => $caption,
            'form' => $form->createView(),
        ]);
    }
}
