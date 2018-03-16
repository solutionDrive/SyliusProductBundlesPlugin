<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSlotSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductBundleSlot::class);
    }

    function it_implements_product_bundle_slot_interface()
    {
        $this->shouldImplement(ProductBundleSlotInterface::class);
    }

    function it_implements_resource_interface()
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_has_a_name()
    {
        $this->setName('top_slot');
        $this->getName()->shouldReturn('top_slot');
    }

    function it_has_a_position()
    {
        $this->setPosition(42);
        $this->getPosition()->shouldReturn(42);
    }

    function it_can_be_assigned_to_a_bundle(ProductBundleInterface $bundle)
    {
        $this->setBundle($bundle);
        $this->getBundle()->shouldReturn($bundle);
    }

    function it_can_add_a_product(ProductInterface $product) {
        $this->addProduct($product);
        $this->getProducts()->shouldContain($product);
    }

    function it_can_remove_a_product(ProductInterface $product) {
        $this->addProduct($product);
        $this->removeProduct($product);
        $this->getProducts()->shouldNotContain($product);
    }
}
