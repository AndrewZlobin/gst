<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class LicensesAndCertificatesGenerator
{
    const IDENTIFIER = 'licensesandcertificates';
    const WRAPPER_CLASS = 'bg-white';

    const LIST_ELEMENTS_COUNTER = 6;
    const MEDIA = [
        'leagueofprospectors',
        'isocertificate',
        'mhcslicense',
        'electricalcertificate'
    ];

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getLicensesAndCertificates(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'caption' => $this->getCaption(),
            'header' => $this->getHeader(),
            'listelements' => $this->getListElements(),
            'files' => $this->getFiles()
        ];
    }

    protected function getHeader(): string
    {
        return $this->translator->trans('licensesandcertificates.header');
    }

    protected function getCaption(): string
    {
        return $this->translator->trans('licensesandcertificates.caption');
    }

    protected function getListElements(): array
    {
        $listelements = [];

        for ($i = 1; $i <= self::LIST_ELEMENTS_COUNTER; $i++) {
            $listelements[$i] = $this->translator->trans("licensesandcertificates.list.element$i");
        }

        return array_values($listelements);
    }

    protected function getFiles(): array
    {
        return self::MEDIA;
    }
}
