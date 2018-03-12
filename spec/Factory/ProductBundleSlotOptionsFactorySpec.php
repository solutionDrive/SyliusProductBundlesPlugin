<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Factory;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactory;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactoryInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleSlotOptionsFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleSlotOptionsFactory::class);
    }

    function it_is_a_factory()
    {
        $this->shouldImplement(FactoryInterface::class);
    }

    function it_is_a_product_bundle_slot_options_factory()
    {
        $this->shouldImplement(ProductBundleSlotOptionsFactoryInterface::class);
    }

    function it_creates_a_new_empty_slot_options_object()
    {
        $this->createNew()->shouldReturnAnInstanceOf(ProductBundleSlotOptionsInterface::class);
    }

    function it_creates_a_new_slot_options_object_with_given_options()
    {
        $position = 1;
        $isPresentationSlot = false;

        $this->createNewWithValues($position, $isPresentationSlot)->shouldReturnAnInstanceOf(ProductBundleSlotOptionsInterface::class);
    }
}
