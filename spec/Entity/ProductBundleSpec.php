<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundle;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundle::class);
    }

    function it_implements_product_bundle_interface()
    {
        $this->shouldImplement(ProductBundleInterface::class);
    }

    function it_implements_resource_interface()
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_has_a_product(ProductInterface $product)
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);
    }

    function it_can_have_a_presentation_slot(
        ProductBundleSlotInterface $productBundleSlot
    ) {
        $this->setPresentationSlot($productBundleSlot);
        $this->getPresentationSlot()->shouldReturn($productBundleSlot);
    }

    function it_can_add_a_slot(ProductBundleSlotInterface $slot)
    {
        $slot->setBundle($this)->shouldBeCalled();
        $this->addSlot($slot);
        $this->getSlots()->shouldContain($slot);
    }

    function it_can_remove_a_slot(ProductBundleSlotInterface $slot)
    {
        $this->addSlot($slot);
        $slot->setBundle(null)->shouldBeCalled();
        $this->removeSlot($slot);
        $this->getSlots()->shouldNotContain($slot);
    }
}
