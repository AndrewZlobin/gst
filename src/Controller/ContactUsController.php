<?php

namespace App\Controller;

use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class ContactUsController extends AbstractController
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/contact/us", name="contact_us")
     */
    public function new(string $header, string $caption, Request $request): Response
    {
        // TODO Move form processing logic to service,
        //  rendering and submitting - to LandingController.php

        $form = $this->createForm(ContactUsType::class, null, [
            'action' => $this->generateUrl('landing')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->convertToEmail((object)$form->getData());
        }

        return $this->render('contact_us/form.html.twig', [
            'controller_name' => 'ContactUsController',
            'formheader' => $header,
            'formcaption' => $caption,
            'form' => $form->createView(),
        ]);
    }

    public function proceed(Request $request)
    {
        $form = $this->createForm(ContactUsType::class);

//        if ($request->isMethod('POST')) {
//            $form->submit($request->request->get($form->getName()));
//
//            if ($form->isSubmitted() && $form->isValid()) {
//                $this->convertToEmail((object)$form->getData());
//            }
//        }
    }

    public function convertToEmail(object $formdata): Response
    {
        $email = (new Email())
            ->from($formdata->email)
            ->to('andrewzlobin1992@gmail.com')
            ->subject($formdata->theme)
            ->text($formdata->message)
            ->text($formdata->phone);

        $this->mailer->send($email);

        $this->addFlash('success', 'Сообщение было отправлено');

        return $this->redirectToRoute('landing');
    }
}
