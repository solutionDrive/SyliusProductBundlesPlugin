<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Entity;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundle;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundleSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundle::class);
    }

    public function it_implements_product_bundle_interface(): void
    {
        $this->shouldImplement(ProductBundleInterface::class);
    }

    public function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    public function it_has_a_product(ProductInterface $product): void
    {
        $this->setProduct($product);
        $this->getProduct()->shouldReturn($product);
    }

    public function it_can_have_a_presentation_slot(
        ProductBundleSlotInterface $productBundleSlot
    ): void {
        $this->setPresentationSlot($productBundleSlot);
        $this->getPresentationSlot()->shouldReturn($productBundleSlot);
    }

    public function it_can_add_a_slot(ProductBundleSlotInterface $slot): void
    {
        $slot->setBundle($this)->shouldBeCalled();
        $this->addSlot($slot);
        $this->getSlots()->shouldContain($slot);
    }

    public function it_can_remove_a_slot(ProductBundleSlotInterface $slot): void
    {
        $this->addSlot($slot);
        $slot->setBundle(null)->shouldBeCalled();
        $this->removeSlot($slot);
        $this->getSlots()->shouldNotContain($slot);
    }
}
