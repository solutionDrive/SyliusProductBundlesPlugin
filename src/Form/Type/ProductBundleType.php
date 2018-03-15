<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Form\Type;

use Sylius\Bundle\ProductBundle\Form\Type\ProductChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductBundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', ProductChoiceType::class, ['label' => 'sylius.ui.product'])
            ->add('slots', CollectionType::class, [
                'entry_type' => ProductBundleSlotType::class,
                'allow_add' => true,
                'label' => false,
                'button_add_label' => 'sylius.form.option_value.add_value',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_bundle';
    }
}
