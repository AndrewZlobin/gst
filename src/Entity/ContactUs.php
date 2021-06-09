<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ContactUs
{
    /**
     * @Assert\NotBlank(message="fullname.not_blank")
     */
    public $fullname;

    /**
     * @Assert\NotBlank(message="email.not_blank")
     * * @Assert\Email(message="email.wrong_format")
     */
    public $email;

    /**
     * @Assert\NotBlank(message="phone.not_blank")
     * @Assert\Regex(
     *     pattern="/\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/",
     *     match="false",
     *     message="phone.wrong_format"
     * )
     */
    public $phone;

    /**
     * @Assert\NotBlank(message="theme.not_blank")
     */
    public $theme;

    /**
     * @Assert\NotBlank(message="message.not_blank")
     */
    public $message;

    public $copyto;
}
