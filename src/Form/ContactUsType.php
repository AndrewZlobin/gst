<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactUsType extends AbstractType
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', TextType::class, $this->generateFieldParams('fullname'))
            ->add('email', EmailType::class, $this->generateFieldParams('email'))
            ->add('phone', TextType::class, $this->generateFieldParams('phone'))
            ->add('theme', TextType::class, $this->generateFieldParams('theme'))
            ->add('message', TextareaType::class, $this->generateFieldParams('message'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

    protected function generateFieldParams(string $field)
    {
        return [
            'attr' => [
                'class' => "contact-us-form__$field",
                'placeholder' => $field
            ],
            'label' => $field,
            'label_attr' => [
                'class' => 'd-none'
            ]
        ];
    }
}
