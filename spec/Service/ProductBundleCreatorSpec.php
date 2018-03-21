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
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleCreatorSpec extends ObjectBehavior
{
    public function let(
        FactoryInterface $productBundleFactory,
        FactoryInterface $productBundleSlotFactory
    ): void {
        $this->beConstructedWith($productBundleFactory, $productBundleSlotFactory);
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
        ProductInterface $smurfOutfit
    ): void {
        $productBundleFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundle);

        $this->createProductBundle($smurfOutfit);

        $this->getProductBundle()
            ->shouldReturn($productBundle);
    }

    public function it_can_add_an_empty_slot_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit
    ): void {
        $productBundleName = 'Hefty Smurfs Outfit';
        $slotName = 'Top Hats';

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundleSlot->setName($slotName)->shouldBeCalled();

        $this
            ->createProductBundle($smurfOutfit)
            ->addSlot($slotName);
    }

    public function it_can_add_a_slot_with_additional_parameters_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions->isPresentationSlot()->willReturn(false);
        $bundleSlotOptions->getPosition()->willReturn(1);

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();

        $this
            ->createProductBundle($smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions);
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

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlot)->shouldBeCalled();
        $productBundle->setPresentationSlot($productBundleSlot)->shouldNotBeCalled();

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();
        $productBundleSlot->addProduct($fedoraHat)->shouldBeCalled();
        $productBundleSlot->addProduct($melonHat)->shouldBeCalled();
        $productBundleSlot->addProduct($smurfHat)->shouldBeCalled();

        $this
            ->createProductBundle($smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions, $products);
    }

    public function it_can_add_multiple_slots_to_a_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlotTopHats,
        ProductBundleSlotInterface $productBundleSlotShirts,
        ProductInterface $smurfOutfit,
        ProductInterface $fedoraHat,
        ProductInterface $smurfHat,
        ProductInterface $whiteShirt,
        ProductBundleSlotOptionsInterface $bundleSlotOptionsHats,
        ProductBundleSlotOptionsInterface $bundleSlotOptionsShirts
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
        $productBundle->addSlot($productBundleSlotTopHats)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlotShirts)->shouldBeCalled();

        $productBundleSlotFactory
            ->createNew()
            ->shouldBeCalledTimes(2)
            ->willReturn($productBundleSlotTopHats, $productBundleSlotShirts);

        $productBundleSlotTopHats->setName($slotNameHats)->shouldBeCalled();
        $productBundleSlotTopHats
            ->setPosition($bundleSlotOptionsHats->getWrappedObject()->getPosition())
            ->shouldBeCalled();
        $productBundleSlotTopHats->addProduct($fedoraHat)->shouldBeCalled();
        $productBundleSlotTopHats->addProduct($smurfHat)->shouldBeCalled();

        $productBundleSlotShirts->setName($slotNameShirts)->shouldBeCalled();
        $productBundleSlotShirts
            ->setPosition($bundleSlotOptionsShirts->getWrappedObject()->getPosition())
            ->shouldBeCalled();
        $productBundleSlotShirts->addProduct($whiteShirt)->shouldBeCalled();

        $this
            ->createProductBundle($smurfOutfit)
            ->addSlot($slotNameHats, $bundleSlotOptionsHats, $productsHats)
            ->addSlot($slotNameShirts, $bundleSlotOptionsShirts, $productsShirts);
    }

    public function it_can_add_a_slot_as_presentation_slot(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ): void {
        $slotName = 'Top Hats';

        $bundleSlotOptions->getPosition()->willReturn(1);
        $bundleSlotOptions->isPresentationSlot()->willReturn(true);

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlot)->shouldBeCalled();
        $productBundle->setPresentationSlot($productBundleSlot)->shouldBeCalled();

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();

        $this
            ->createProductBundle($smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions);
    }
}
