<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Factory;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactory;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactoryInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleSlotOptionsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleSlotOptionsFactory::class);
    }

    public function it_is_a_factory(): void
    {
        $this->shouldImplement(FactoryInterface::class);
    }

    public function it_is_a_product_bundle_slot_options_factory(): void
    {
        $this->shouldImplement(ProductBundleSlotOptionsFactoryInterface::class);
    }

    public function it_creates_a_new_empty_slot_options_object(): void
    {
        $this->createNew()->shouldReturnAnInstanceOf(ProductBundleSlotOptionsInterface::class);
    }

    public function it_creates_a_new_slot_options_object_with_given_options(): void
    {
        $position = 1;
        $isPresentationSlot = false;

        $this->createNewWithValues($position, $isPresentationSlot)->shouldReturnAnInstanceOf(ProductBundleSlotOptionsInterface::class);
    }

    public function it_creates_a_new_slot_options_object_with_additional_options(): void
    {
        $position = 1;
        $isPresentationSlot = true;
        $additionalOptions = [
            'super_fancy_option' => 'super_fancy_value',
        ];

        $this->createNewWithValues($position, $isPresentationSlot, $additionalOptions)->shouldReturnAnInstanceOf(ProductBundleSlotOptionsInterface::class);
    }
}
