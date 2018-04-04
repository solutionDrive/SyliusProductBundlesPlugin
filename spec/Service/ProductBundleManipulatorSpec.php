<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleManipulator;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleManipulatorInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleManipulatorSpec extends ObjectBehavior
{
    public function let(
        FactoryInterface $productBundleSlotFactory
    ): void {
        $this->beConstructedWith($productBundleSlotFactory);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleManipulator::class);
    }

    public function it_implements_the_product_bundle_manipulator_interface(): void
    {
        $this->shouldImplement(ProductBundleManipulatorInterface::class);
    }

    public function it_sets_a_given_product_bundle(ProductBundleInterface $productBundle): void
    {
        $this->setProductBundle($productBundle);
        $this->getProductBundle()->shouldReturn($productBundle);
    }

    public function it_can_add_an_empty_slot_to_the_given_bundle(
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot
    ): void {
        $slotName = 'Footwear';
        $productBundleSlotFactory->createNew()->willReturn($productBundleSlot);
        $productBundleSlot->setName($slotName)->shouldBeCalled();

        $productBundle->addSlot($productBundleSlot)->shouldBeCalled();

        $this->setProductBundle($productBundle);

        $this->addSlot($slotName);
    }

    public function it_can_add_a_slot_with_additional_parameters_to_the_bundle(
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions
            ->isPresentationSlot()
            ->willReturn(false)
            ->shouldBeCalled();
        $bundleSlotOptions
            ->getPosition()
            ->willReturn(1)
            ->shouldBeCalled();

        $productBundleSlotFactory
            ->createNew()
            ->willReturn($productBundleSlot)
            ->shouldBeCalled();

        $productBundleSlot
            ->setName($slotName)
            ->shouldBeCalled();
        $productBundleSlot
            ->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())
            ->shouldBeCalled();

        $productBundle
            ->addSlot($productBundleSlot)
            ->shouldBeCalled();

        $this->setProductBundle($productBundle);

        $this->addSlot($slotName, $bundleSlotOptions);
    }

    public function it_can_add_a_slot_with_additional_parameters_and_products_to_the_bundle(
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductInterface $fedoraHat,
        ProductInterface $melonHat,
        ProductInterface $smurfHat,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions->isPresentationSlot()->willReturn(false);
        $bundleSlotOptions->getPosition()->willReturn(1);
        $products = [
            $fedoraHat,
            $melonHat,
            $smurfHat,
        ];

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundle->addSlot($productBundleSlot)->shouldBeCalled();
        $productBundle->setPresentationSlot($productBundleSlot)->shouldNotBeCalled();

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();
        $productBundleSlot->addProduct($fedoraHat)->shouldBeCalled();
        $productBundleSlot->addProduct($melonHat)->shouldBeCalled();
        $productBundleSlot->addProduct($smurfHat)->shouldBeCalled();

        $this->setProductBundle($productBundle);
        $this->addSlot($slotName, $bundleSlotOptions, $products);
    }
}
