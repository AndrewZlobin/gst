<?php


namespace App\Service;


use App\Controller\ContactUsController;

class BlocksForAboutUsPage
{
    private NavbarGenerator $navbar;
    private SubHeadersGenerator $subheader;
    private CompanyReferenceGenerator $companyreference;

    public function __construct(NavbarGenerator $navbar,
                                SubHeadersGenerator $subheader,
                                CompanyReferenceGenerator $companyreference)
    {
        $this->navbar = $navbar;
        $this->subheader = $subheader;
        $this->companyreference = $companyreference;
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
}
