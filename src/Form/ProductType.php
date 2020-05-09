<?php

namespace App\Form;

use App\Entity\Unity;
use App\Form\ImageProductType;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Emplacement;
use App\Form\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('classifiedIn', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => 'Catégorie',
                'required' => true,
            ])
            ->add('placeIn', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => 'Emplacement',
                'required' => true,
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('units', EntityType::class, [
                'class' => Unity::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => 'Unité',
                'required' => true,
            ])
            ->add('purchaseDate', DateType::class)
            ->add('expirationDate', DateType::class)
            ->add('bestBeforeDate', DateType::class)
            ->add('imageProduct', ImageProductType::class, [ 'required' => false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
