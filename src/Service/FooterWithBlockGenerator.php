<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class FooterWithBlockGenerator
{
    const IDENTIFIER = 'footer';
    const TITLE_TRANSLATION = 'footer.title';
    const BLOCKS = [
        'phone',
        'email',
        'city',
        'address',
    ];
    const ICONS = [
        'phone',
        'email',
        'address',
    ];
    const LINKS = 'links';

    private TranslatorInterface $translator;
    private NavbarGenerator $navbar;

    public function __construct(TranslatorInterface $translator,
                                NavbarGenerator $navbar)
    {
        $this->translator = $translator;
        $this->navbar = $navbar;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getFooter($footercontent): array
    {
        return [
            'footercontent' => $footercontent,
            'title' => $this->getTitle(),
            'blocks' => [
                'titles' => $this->getBlocks(),
                'icons' => $this->getIcons(),
            ],
            'links' => $this->getLinks(),
        ];
    }

    protected function getTitle()
    {
        $translationid = self::IDENTIFIER;

        return $this->translator->trans("${translationid}.title");
    }

    protected function getBlocks(): array
    {
        $translationid = self::IDENTIFIER;

        $blocks = [];

        foreach (self::BLOCKS as $block) {
            $blocks[$block] = $this->translator->trans("${translationid}.blocks.${block}");
        }

        return $blocks;
    }

    protected function getIcons(): array
    {
        $icons = [];

        foreach (self::ICONS as $icon) {
            $icons[$icon] = $icon;
        }

        return $icons;
    }

    protected function getLinks(): array
    {
        return $this->navbar->getNavbar()[self::LINKS];
    }
}
