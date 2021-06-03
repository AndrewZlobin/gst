<?php

namespace App\Controller;

use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactUsController extends AbstractController
{
    const FORM_IDENTIFIER = 'form';
    const COPY_TO_IDENTIFIER = 'copyto';
    const TWIG_FOR_EMAIL = 'emails/new.html.twig';
    // TODO Rewrite emails
    const SEND_TO = 'info@box.com';

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

    protected $header;
    protected $caption;
    protected $copyto;

    public function __construct(TranslatorInterface $translator,
                                MailerInterface $mailer)
    {
        $this->translator = $translator;
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     */
    public function setHeader(string $page): void
    {
        $translatorid = self::FORM_IDENTIFIER . ".$page";

        $this->header = $this->translator->trans("${translatorid}.header");
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param mixed $caption
     */
    public function setCaption($page): void
    {
        $translatorid = self::FORM_IDENTIFIER . ".$page";

        $this->caption = $this->translator->trans("${translatorid}.caption");
    }

    /**
     * @return mixed
     */
    public function getCopyto()
    {
        return $this->copyto;
    }

    /**
     * @param mixed $copyto
     */
    public function setCopyto($copyto): void
    {
        $this->copyto = $copyto;
    }

    /**
     * @Route("/contactus", name="contact_us", methods={"GET", "POST"})
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactUsType::class, null, [
            'action' => $this->generateUrl('contact_us'),
        ])
            ->add(self::COPY_TO_IDENTIFIER, HiddenType::class, [
                'data' => $this->getCopyto(),
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->convertToEmail((object)$form->getData());
            } catch (TransportExceptionInterface $e) {
                return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->render('contact_us/form.html.twig', [
            'controller_name' => 'ContactUsController',
            'formheader' => $this->getHeader(),
            'formcaption' => $this->getCaption(),
            'form' => $form->createView(),
            'formstatuses' => $this->getFormStatuses(),
        ]);
    }

    public function convertToEmail(object $formdata)
    {
        $emailcontext = [
            'fullname' => $formdata->fullname,
            'phone' => $formdata->phone,
            'useremail' => $formdata->email,
            'theme' => $formdata->theme,
            'message' => $formdata->message
        ];

        $email = (new TemplatedEmail())
            ->from($formdata->email)
            ->to(self::SEND_TO)
            ->subject($formdata->theme)
            ->htmlTemplate(self::TWIG_FOR_EMAIL)
            ->context($emailcontext);

        if (isset($formdata->copyto)) {
            $email->cc($formdata->copyto);
        }

        $this->mailer->send($email);
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
        return $translatedstatuses;
    }
}
