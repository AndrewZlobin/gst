<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class CustomersAndReviewsGenerator
{
    const IDENTIFIER = 'customersandreviews';
    const WRAPPER_CLASS = 'bg-custom-gray-color';

    const CUSTOMERS_IDENTIFIER = 'customers';
    const REVIEWS_IDENTIFIER = 'customers';
    const MAX_COLUMN_SIZE = 17;

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getCustomers(): array
    {
        return [
            'extracontainerclasses' => self::WRAPPER_CLASS,
            'customers' => [
                'header' => $this->getHeader(self::CUSTOMERS_IDENTIFIER),
                'caption' => $this->getCaption(self::CUSTOMERS_IDENTIFIER),
                'customersleft' => $this->getData()->leftcolumn,
                'customersright' => $this->getData()->rightcolumn,
            ],
            'reviews' => [
                'header' => $this->getHeader(self::REVIEWS_IDENTIFIER),
                'caption' => $this->getCaption(self::REVIEWS_IDENTIFIER),
                'reviews' => $this->getData()->reviews,
            ],
        ];
    }

    protected function getHeader(string $translationid): string
    {
        return $this->translator->trans("customersandreviews.${translationid}.header");
    }

    protected function getCaption(string $translationid): string
    {
        return $this->translator->trans("customersandreviews.${translationid}.caption");
    }

    protected function getData(): object
    {
        $customerslist = [
            'leftcolumn' => [],
            'rightcolumn' => [],
            'reviews' => [],
        ];

        for ($i = 1; $i <= self::MAX_COLUMN_SIZE; $i++) {
            $leftcolumntransid = "customersandreviews.customers.customerleftcolumn${i}";
            $rightcolumntransid = "customersandreviews.customers.customerrightcolumn${i}";

            $customerslist['leftcolumn'][$i] = $this->translator->trans($leftcolumntransid);
            $customerslist['rightcolumn'][$i] = $this->translator->trans($rightcolumntransid);
            $customerslist['reviews'][$i] = "review${i}";
        }

        return (object)$customerslist;
    }
}
