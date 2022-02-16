<?php


namespace App\Service;


use Symfony\Contracts\Translation\TranslatorInterface;

class CompanyReferenceGenerator
{
    const IDENTIFIER = 'companyreference';
    const WRAPPER_CLASS = 'bg-white';

    const TRANSLATION_PREFIX = 'about_us.info';

    const DIRECTIONS_LIST_LENGTH = 4;

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getReference(): array
    {
        $prefix = self::TRANSLATION_PREFIX;

        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'caption' => $this->translator->trans("${prefix}.caption"),
            'directionheader' => $this->translator->trans("${prefix}.directions"),
            'directions' => $this->getDirectionsList(),
            'message' => $this->translator->trans("${prefix}.message"),
        ];
    }

    protected function getDirectionsList(): array
    {
        $prefix = self::TRANSLATION_PREFIX;

        $directionslist = [];

        for ($i = 1; $i <= self::DIRECTIONS_LIST_LENGTH; $i++) {
            $directionslist[$i] = $this->translator->trans("${prefix}.direction${i}");
        }

        return $directionslist;
    }
}
