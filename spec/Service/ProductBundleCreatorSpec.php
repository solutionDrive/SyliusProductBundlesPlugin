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
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreator;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreatorInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleManipulatorInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleCreatorSpec extends ObjectBehavior
{
    public function let(
        FactoryInterface $productBundleFactory,
        ProductBundleManipulatorInterface $productBundleManipulator
    ): void {
        $this->beConstructedWith($productBundleFactory, $productBundleManipulator);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleCreator::class);
    }

    public function it_implements_the_product_bundle_creator_interface(): void
    {
        $this->shouldImplement(ProductBundleCreatorInterface::class);
    }

    public function it_can_create_a_new_product_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductInterface $smurfOutfit,
        ProductBundleManipulatorInterface $productBundleManipulator
    ): void {
        $productBundleFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundle);

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->getProductBundle()->willReturn($productBundle)->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);

        $this->getProductBundle()
            ->shouldReturn($productBundle);
    }

    public function it_can_add_an_empty_slot_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductBundleManipulatorInterface $productBundleManipulator,
        ProductInterface $smurfOutfit
    ): void {
        $slotName = 'Top Hats';

        $productBundleFactory
            ->createNew()
            ->willReturn($productBundle)
            ->shouldBeCalled();

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotName, null, [])->shouldBeCalled();
        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);
        $this->addSlot($slotName);
    }

    public function it_can_add_a_slot_with_additional_parameters_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductInterface $smurfOutfit,
        ProductBundleManipulatorInterface $productBundleManipulator,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions->isPresentationSlot()->willReturn(false);
        $bundleSlotOptions->getPosition()->willReturn(1);

        $productBundleFactory
            ->createNew()
            ->willReturn($productBundle)
            ->shouldBeCalled();

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotName, $bundleSlotOptions, [])->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);
        $this->addSlot($slotName, $bundleSlotOptions);
    }

    public function it_can_add_a_slot_with_additional_parameters_and_products_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductInterface $fedoraHat,
        ProductInterface $melonHat,
        ProductInterface $smurfHat,
        ProductBundleManipulatorInterface $productBundleManipulator,
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

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundle->setPresentationSlot($productBundleSlot)->shouldNotBeCalled();

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotName, $bundleSlotOptions, $products)->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);
        $this->addSlot($slotName, $bundleSlotOptions, $products);
    }

    public function it_can_add_multiple_slots_to_a_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductInterface $smurfOutfit,
        ProductInterface $fedoraHat,
        ProductInterface $smurfHat,
        ProductInterface $whiteShirt,
        ProductBundleSlotOptionsInterface $bundleSlotOptionsHats,
        ProductBundleSlotOptionsInterface $bundleSlotOptionsShirts,
        ProductBundleManipulatorInterface $productBundleManipulator
    ): void {
        $slotNameHats = 'Top Hats';
        $bundleSlotOptionsHats->isPresentationSlot()->willReturn(false);
        $bundleSlotOptionsHats->getPosition()->willReturn(1);

        $productsHats = [
            $fedoraHat,
            $smurfHat,
        ];

        $slotNameShirts = 'Shirts';
        $bundleSlotOptionsShirts->isPresentationSlot()->willReturn(false);
        $bundleSlotOptionsShirts->getPosition()->willReturn(2);

        $productsShirts = [
            $whiteShirt,
        ];

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotNameHats, $bundleSlotOptionsHats, $productsHats)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotNameShirts, $bundleSlotOptionsShirts, $productsShirts)->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);
        $this->addSlot($slotNameHats, $bundleSlotOptionsHats, $productsHats);
        $this->addSlot($slotNameShirts, $bundleSlotOptionsShirts, $productsShirts);
    }

    public function it_can_add_a_slot_as_presentation_slot(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductInterface $smurfOutfit,
        ProductBundleManipulatorInterface $productBundleManipulator,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions->getPosition()->willReturn(1);
        $bundleSlotOptions->isPresentationSlot()->willReturn(true);

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->addSlot($slotName, $bundleSlotOptions, [])->shouldBeCalled();

        $this->createProductBundle($smurfOutfit);
        $this->addSlot($slotName, $bundleSlotOptions);
    }
}
