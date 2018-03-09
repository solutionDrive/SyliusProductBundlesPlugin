<?php

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotFactory;
use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotFactoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleSlotFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleSlotFactory::class);
    }

    function it_is_a_factory()
    {
        $this->shouldImplement(FactoryInterface::class);
    }

    function it_is_a_product_bundle_slot_factory()
    {
        $this->shouldImplement(ProductBundleSlotFactoryInterface::class);
    }

    function it_creates_a_new_product_bundle_slot()
    {
        $this->createNew()->shouldReturnAnInstanceOf(ProductBundleSlotInterface::class);
    }
}
