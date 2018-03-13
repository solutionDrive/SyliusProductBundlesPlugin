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
use Symfony\Component\Form\FormBuilderInterface;

class ProductBundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', ProductChoiceType::class, ['label' => 'sylius.ui.product'])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_bundle';
    }
}
