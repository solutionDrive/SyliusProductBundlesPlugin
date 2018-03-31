<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSlotSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleSlot::class);
    }

    public function it_implements_product_bundle_slot_interface(): void
    {
        $this->shouldImplement(ProductBundleSlotInterface::class);
    }

    public function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    public function it_has_a_name(): void
    {
        $this->setName('top_slot');
        $this->getName()->shouldReturn('top_slot');
    }

    public function it_has_a_position(): void
    {
        $this->setPosition(42);
        $this->getPosition()->shouldReturn(42);
    }

    public function it_can_be_assigned_to_a_bundle(ProductBundleInterface $bundle): void
    {
        $this->setBundle($bundle);
        $this->getBundle()->shouldReturn($bundle);
    }

    public function it_can_add_a_product(ProductInterface $product): void
    {
        $this->addProduct($product);
        $this->getProducts()->shouldContain($product);
    }

    public function it_can_tell_if_it_has_product(
        ProductInterface $assignedProduct,
        ProductInterface $notAssignedProduct
    ) {
        $this->addProduct($assignedProduct);
        $this->hasProduct($assignedProduct)->shouldReturn(true);
        $this->hasProduct($notAssignedProduct)->shouldReturn(false);
    }

    public function it_can_remove_a_product(ProductInterface $product): void
    {
        $this->addProduct($product);
        $this->removeProduct($product);
        $this->getProducts()->shouldNotContain($product);
    }
}
