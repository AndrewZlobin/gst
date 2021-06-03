<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ContactUs
{
    /**
     * @Assert\NotBlank
     */
    public $fullname;

    /**
     * @Assert\NotBlank
     * * @Assert\Email(
     *     message = "'{{ value }}' не является корректным"
     * )
     */
    public $email;

    /**
     * @Assert\NotBlank
     */
    public $phone;

    /**
     * @Assert\NotBlank
     */
    public $theme;

    /**
     * @Assert\NotBlank
     */
    public $message;

    /**
     * @Assert\NotNull
     */
    public $copyto;
}
