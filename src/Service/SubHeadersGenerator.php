<?php


namespace App\Service;


use Symfony\Contracts\Translation\TranslatorInterface;

class SubHeadersGenerator
{
    const IDENTIFIER = 'subheader';
    const WRAPPER_CLASS = 'bg-white';

    const TYPE_UNDERLINE = 'underline';
    const TYPE_LEFT = 'left';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getSubHeader(string $page, string $linetype = ''): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'header' => $this->translator->trans("subheaders.${page}"),
            'linetype' => empty($linetype)
                ? self::TYPE_UNDERLINE
                : self::TYPE_LEFT,
            'modification' => $page
        ];
    }
}
