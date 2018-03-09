<?php

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreator;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleCreatorSpec extends ObjectBehavior
{
    function let(
        FactoryInterface $productBundleFactory,
        FactoryInterface $productBundleSlotFactory
    ) {
        $this->beConstructedWith($productBundleFactory, $productBundleSlotFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleCreator::class);
    }

    // @todo enforce interface (create it when all public methods are speced)

    function it_can_create_a_new_product_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle
    ) {
        $productBundleFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundle)
        ;

        $this->createProductBundle();
        $this
            ->getProductBundle()
            ->shouldReturn($productBundle);
    }

    function it_can_add_an_empty_slot_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot
    ) {
        $slotName = 'Top Heads';

        $productBundleFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundle)
        ;
        $productBundleSlotFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundleSlot)
        ;
        $productBundleSlot
            ->setName($slotName)
            ->shouldBeCalled()
        ;
        $productBundleSlot
            ->setBundle($productBundle)
            ->shouldBeCalled()
        ;

        $this->createProductBundle()
            ->addSlot($slotName)
        ;
    }
}
