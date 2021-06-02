<?php

namespace App\Controller;

use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactUsController extends AbstractController
{
    const FORM_STATUSES = [
        'opened' => [
            'identifier' => 'opened',
            'status' => 1
        ],
        'loading' => [
            'identifier' => 'loading',
            'status' => 3
        ],
        'sent' => [
            'identifier' => 'sent',
            'status' => 4,
            'iserror' => 'false',
        ],
        'error' => [
            'identifier' => 'error',
            'status' => 4,
            'iserror' => 'true',
        ],
    ];

    private TranslatorInterface $translator;
    private MailerInterface $mailer;

    public function __construct(TranslatorInterface $translator,
                                MailerInterface $mailer)
    {
        $this->translator = $translator;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/contactus", name="contact_us")
     */
    public function new(string $header, string $caption, Request $request): Response
    {
        $form = $this->createForm(ContactUsType::class, null, [
            'action' => $this->generateUrl('contact_us_handle'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
//            $this->convertToEmail((object)$form->getData());
        }

        return $this->render('contact_us/form.html.twig', [
            'controller_name' => 'ContactUsController',
            'formheader' => $header,
            'formcaption' => $caption,
            'form' => $form->createView(),
            'formstatuses' => $this->getFormStatuses(),
        ]);
    }

    public function proceed(Request $request)
    {
        $form = $this->createForm(ContactUsType::class);
    }

    public function convertToEmail(object $formdata)
    {
        $email = (new Email())
            ->from($formdata->email)
            ->to('andrewzlobin1992@gmail.com')
            ->subject($formdata->theme)
            ->text($formdata->message)
            ->text($formdata->phone);
        $this->mailer->send($email);
    }

    /**
     * @Route("/contactushandle", name="contact_us_handle", methods={"GET", "POST"})
     */
    public function handle(Request $request): Response
    {
        $form = $this->createForm(ContactUsType::class, null, [
            'action' => $this->generateUrl('contact_us_handle'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->convertToEmail((object)$form->getData());
            } catch (TransportExceptionInterface $e) {
                dump($e);
                return new Response('Error', Response::HTTP_BAD_REQUEST);
            }
        }

        return new Response('Email sent', Response::HTTP_OK);
    }

    protected function getFormStatuses()
    {
        $translatedstatuses = [];

        foreach (self::FORM_STATUSES as $key => $formstatus) {
            $translatedstatuses[$key]['name'] = $this->translator->trans("form.statuses.${formstatus['identifier']}");
            $translatedstatuses[$key]['status'] = $formstatus['status'];

            if (array_key_exists('iserror', $formstatus)) {
                $translatedstatuses[$key]['iserror'] = $formstatus['iserror'];
            }
        }
        dump($translatedstatuses);
        return $translatedstatuses;
    }
}
