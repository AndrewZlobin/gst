<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class FooterWithBlockGenerator
{
    const IDENTIFIER = 'footer';
    const WRAPPER_CLASS = 'bg-transparent block-footer block-footer__with-content';

    const CAPTION = 'address';
    const BLOCK_HAS_CAPTION = 'city';
    const BLOCKS = [
        'phone',
        'email',
        'city',
    ];
    const ICONS = [
        'phone',
        'email',
        'map',
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
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'title' => $this->getTitle(),
            'blocks' => $this->getBlocks(),
            'links' => $this->getLinks(),
        ];
    }

    protected function getTitle()
    {
        $translationid = self::IDENTIFIER;

        return $this->translator->trans("${translationid}.title");
    }

    public function getBlocks(): array
    {
        $translationid = self::IDENTIFIER;

        $blocks = [];

        foreach (self::BLOCKS as $key => $block) {
            $blocks[$block]['title'] = $this
                ->translator
                ->trans("${translationid}.blocks.${block}");

            if ($block === self::BLOCK_HAS_CAPTION) {
                $captiontranslation = self::CAPTION;

                $blocks[$block]['caption'] = $this
                    ->translator
                    ->trans("${translationid}.blocks.${captiontranslation}");
            }

            if (array_key_exists($key, self::ICONS)) {
                $blocks[$block]['icon'] = self::ICONS[$key];
            }
        }

        return $blocks;
    }

    protected function getLinks(): array
    {
        return $this->navbar->getNavbar()[self::LINKS];
    }
}
