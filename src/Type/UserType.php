<?php


namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Imię','attr' => array('class' => 'Css-class-name')])//'attr' => array('class' => 'fieldClass') -> dodaje klasę w css
            ->add('surname', TextType::class, ['required' => false, 'label' => 'Nazwisko'])
            ->add('iceLover', CheckboxType::class, ['required' => false, 'label' => 'Lubi lody'])
            ->add('Add', SubmitType::class, ['label'=>'Dodaj']);
    }

}