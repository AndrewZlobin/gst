<?php


namespace App\Service;


use Symfony\Contracts\Translation\TranslatorInterface;

class FooterWithFormGenerator
{
    const IDENTIFIER = 'footer';
    const FORM_IDENTIFIER = 'form';
    const WRAPPER_CLASS = 'bg-transparent block-footer block-footer__with-form';

    const SEPARATOR = ', ';

    const OFFICES_ICON = 'map';

    private TranslatorInterface $translator;
    private FooterWithBlockGenerator $footer;
    private MapGenerator $map;

    public function __construct(TranslatorInterface $translator,
                                FooterWithBlockGenerator $footer,
                                MapGenerator $map)
    {
        $this->translator = $translator;
        $this->footer = $footer;
        $this->map = $map;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getFooterWithForm($footercontent, string $page): array
    {
        return [
            'footercontent' => $footercontent,
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'blocks' => $this->getFooterBlocks(),
            'officestitle' => $this->getFooterOfficesHeader(),
            'offices' => $this->getOfficesData(),
            'formdata' => $this->getFormDataForPage($page),
        ];
    }

    protected function getFooterBlocks(): array
    {
        return $this->footer->getBlocks();
    }

    protected function getFooterOfficesHeader(): string
    {
        $translatorid = self::IDENTIFIER;

        return $this->translator->trans("${translatorid}.offices");
    }

    protected function getOfficesData(): array
    {
        $offices = [];

        foreach ($this->map->getOfficesForMap()['points'] as $city => $office) {
            $officecaption = explode(self::SEPARATOR, $office['caption']);
            $header = $officecaption[array_key_first($officecaption)] . self::SEPARATOR;

            $captioncopy = $officecaption;
            unset($captioncopy[array_key_first($captioncopy)]);

            $offices[$city]['header'] = trim($header);
            $offices[$city]['caption'] = implode(self::SEPARATOR, $captioncopy);
            $offices[$city]['icon'] = self::OFFICES_ICON;
        }

        return $offices;
    }

    protected function getFormDataForPage(string $page): array
    {
        $translatorid = self::FORM_IDENTIFIER . ".$page";

        return [
            'header' => $this->translator->trans("${translatorid}.header"),
            'caption' => $this->translator->trans("${translatorid}.caption"),
        ];
    }
}
