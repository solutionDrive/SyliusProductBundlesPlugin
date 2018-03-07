<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace SolutionDrive\SyliusProductBundlesPlugin\Form\Type;

use Sylius\Bundle\ProductBundle\Form\Type\ProductChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductBundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', SearchType::class, ['label' => 'sylius.ui.name'])
            ->add('code', TextType::class, ['label' => 'sylius.ui.code'])
            ->add('product', ProductChoiceType::class, ['label' => 'sylius.ui.product'])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_bundle';
    }
}
