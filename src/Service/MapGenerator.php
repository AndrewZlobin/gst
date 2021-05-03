<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class MapGenerator
{
    const IDENTIFIER = 'offices';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getOfficesForMap(): array
    {
        $translationid = self::IDENTIFIER;

        $points = [];
        $points['header'] = $this->translator->trans("${translationid}.header");

        return $points;
    }
}
