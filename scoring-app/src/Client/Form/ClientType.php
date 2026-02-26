<?php

namespace App\Client\Form;

use Symfony\Component\Form\AbstractType;
use App\Enum\EducationLevel;
use App\Client\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Имя: '])
            ->add('lastName', TextType::class, ['label' => 'Фамилия: '])
            ->add('phone', TextType::class, ['label' => 'Телефон: '])
            ->add('email', EmailType::class, ['label' => 'Email: '])
            ->add('education', ChoiceType::class, [
                'choices' => EducationLevel::cases(),
                'choice_label' => fn(EducationLevel $level) => $level->value,
                'label' => 'Образование: ',
            ])
            ->add('consent', CheckboxType::class, [
                'label' => 'Я даю согласие на обработку моих личных данных: ',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
