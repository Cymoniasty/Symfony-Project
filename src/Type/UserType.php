<?php


namespace App\Type;


use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            //'attr' => array('class' => 'fieldClass') -> dodaje klasę w css
            ->add('name', TextType::class, ['label'=>'Imię'])
            ->add('surname', TextType::class, ['required' => false, 'label' => 'Nazwisko'])
            ->add('iceLover', CheckboxType::class, ['required' => false, 'label' => 'Lubi lody'])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('add', SubmitType::class, ['label'=>'Dodaj']);
    }

}