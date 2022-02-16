<?php


namespace App\Service;


use App\Controller\ContactUsController;
use Symfony\Contracts\Translation\TranslatorInterface;

class BlocksForAboutUsPage
{
    const MAP_CAPTION_TRANSLATION_KEY = 'offices.caption';

    private TranslatorInterface $translator;
    private NavbarGenerator $navbar;
    private SubHeadersGenerator $subheader;
    private CompanyReferenceGenerator $companyreference;
    private MapGenerator $map;
    private LicensesAndCertificatesGenerator $licensesandcertificates;
    private CustomersAndReviewsGenerator $customersandreviews;
    private CustomersFeedbackGenerator $customersfeedback;
    private FooterWithBlockGenerator $footerwithblockgenerator;

    public function __construct(TranslatorInterface $translator,
                                NavbarGenerator $navbar,
                                SubHeadersGenerator $subheader,
                                CompanyReferenceGenerator $companyreference,
                                MapGenerator $map,
                                LicensesAndCertificatesGenerator $licensesandcertificates,
                                CustomersAndReviewsGenerator $customersandreviews,
                                CustomersFeedbackGenerator $customersfeedback,
                                FooterWithBlockGenerator $footerwithblockgenerator)
    {
        $this->translator = $translator;
        $this->navbar = $navbar;
        $this->subheader = $subheader;
        $this->companyreference = $companyreference;
        $this->map = $map;
        $this->licensesandcertificates = $licensesandcertificates;
        $this->customersandreviews = $customersandreviews;
        $this->customersfeedback = $customersfeedback;
        $this->footerwithblockgenerator = $footerwithblockgenerator;
    }

    /**
     * @return NavbarGenerator
     */
    public function getNavbar(): NavbarGenerator
    {
        return $this->navbar;
    }

    /**
     * @return SubHeadersGenerator
     */
    public function getSubheader(): SubHeadersGenerator
    {
        return $this->subheader;
    }

    /**
     * @return CompanyReferenceGenerator
     */
    public function getCompanyreference(): CompanyReferenceGenerator
    {
        return $this->companyreference;
    }

    /**
     * @return MapGenerator
     */
    public function getMap(): MapGenerator
    {
        $this->map->setMapcaption($this->translator->trans(self::MAP_CAPTION_TRANSLATION_KEY));
        $this->map->setUsedefaultwrapper(true);

        return $this->map;
    }

    /**
     * @return LicensesAndCertificatesGenerator
     */
    public function getLicensesandcertificates(): LicensesAndCertificatesGenerator
    {
        return $this->licensesandcertificates;
    }

    /**
     * @return CustomersAndReviewsGenerator
     */
    public function getCustomersandreviews(): CustomersAndReviewsGenerator
    {
        return $this->customersandreviews;
    }

    public function getCustomersFeedbacks(): CustomersFeedbackGenerator
    {
        return $this->customersfeedback;
    }

    public function getFooter()
    {
        return $this->footerwithblockgenerator;
    }
}
