<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvantagesGenerator
{
    const IDENTIFIER = 'advantages';
    const WRAPPER_CLASS = 'bg-white';

    const PROFESSIONALS = 'professionals';
    const PERMISSIONS = 'permissions';
    const GEOGRAPHY = 'geography';
    const TECHNICS = 'technics';
    const LENDING = 'lending';
    const ATTRIBUTION = 'attribution';

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getAdvantagesBlocks(): array
    {
        $advantages = [];

        foreach ($this->getAdvantages() as $advantage) {
            $title = $this->translator->trans("advantages.${advantage}.title");
            $message = $this->translator->trans("advantages.${advantage}.message");

            $advantages['blocks'][$advantage]['title'] = $title;
            $advantages['blocks'][$advantage]['message'] = $message;
        }

        $advantages['extracontainerclasses'] = self::WRAPPER_CLASS;

        return $advantages;
    }

    private function getAdvantages()
    {
        return [
            self::PROFESSIONALS,
            self::PERMISSIONS,
            self::GEOGRAPHY,
            self::TECHNICS,
            self::LENDING,
            self::ATTRIBUTION,
        ];
    }
}
