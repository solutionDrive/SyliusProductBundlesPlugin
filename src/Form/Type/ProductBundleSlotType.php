<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Form\Type;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductBundleSlotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
                'constraints' => [new NotBlank()],
            ])
            ->add('products', ProductAutocompleteChoiceType::class, [
                'label' => 'sylius.ui.products',
                'multiple' => true,
                'by_reference' => false,
                'required' => false,
            ])
            ->add('position', IntegerType::class, [
                'label' => 'solutiondrive.ui.position',
            ])
            ->add('isPresentationSlot', CheckboxType::class, [
                'label' => 'solutiondrive.ui.presentation_slot',
                'attr'  => ['data-qa' => 'presentation-slot'],
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_bundle_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductBundleSlot::class,
        ]);
    }
}
