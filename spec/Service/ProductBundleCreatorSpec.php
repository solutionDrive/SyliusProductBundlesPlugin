<?php

declare(strict_types=1);

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreator;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleCreatorInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
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

    function it_implements_the_product_bundle_creator_interface()
    {
        $this->shouldImplement(ProductBundleCreatorInterface::class);
    }

    function it_can_create_a_new_product_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        ProductInterface $smurfOutfit
    ) {
        $productBundleName = 'Brainy Smurfs Outfit';
        $productBundleFactory
            ->createNew()
            ->shouldBeCalled()
            ->willReturn($productBundle)
        ;

        $this->createProductBundle($productBundleName, $smurfOutfit);

        $this->getProductBundle()
            ->shouldReturn($productBundle);
    }

    function it_can_add_an_empty_slot_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit
    ) {
        $productBundleName = 'Hefty Smurfs Outfit';
        $slotName = 'Top Hats';

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setBundle($productBundle)->shouldBeCalled();

        $this
            ->createProductBundle($productBundleName, $smurfOutfit)
            ->addSlot($slotName)
        ;
    }

    function it_can_add_a_slot_with_additional_parameters_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ) {
        $productBundleName = 'Clumsy Smurfs Outfit';
        $slotName = 'Top Hats';

        $bundleSlotOptions->isPresentationSlot()->willReturn(false);
        $bundleSlotOptions->getPosition()->willReturn(1);

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setBundle($productBundle)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();

        $this
            ->createProductBundle($productBundleName, $smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions)
        ;
    }

    function it_can_add_a_slot_with_additional_parameters_and_products_to_the_bundle(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductInterface $fedoraHat,
        ProductInterface $melonHat,
        ProductInterface $smurfHat,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ) {
        $productBundleName = 'Jokey Smurfs Outfit';
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
        $productBundle->setName($productBundleName)->shouldBeCalled();

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setBundle($productBundle)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();
        $productBundleSlot->addProduct($fedoraHat)->shouldBeCalled();
        $productBundleSlot->addProduct($melonHat)->shouldBeCalled();
        $productBundleSlot->addProduct($smurfHat)->shouldBeCalled();

        $this
            ->createProductBundle($productBundleName, $smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions, $products)
        ;
    }

    function it_can_add_multiple_slots_to_a_bundle(
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
    ) {
        $productBundleName = 'Lucky Smurfs Outfit';

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

        $productBundle->setName($productBundleName)->shouldBeCalled();
        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlotTopHats)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlotShirts)->shouldBeCalled();

        $productBundleSlotFactory
            ->createNew()
            ->shouldBeCalledTimes(2)
            ->willReturn($productBundleSlotTopHats, $productBundleSlotShirts)
        ;

        $productBundleSlotTopHats->setName($slotNameHats)->shouldBeCalled();
        $productBundleSlotTopHats
            ->setPosition($bundleSlotOptionsHats->getWrappedObject()->getPosition())
            ->shouldBeCalled();
        $productBundleSlotTopHats->setBundle($productBundle)->shouldBeCalled();
        $productBundleSlotTopHats->addProduct($fedoraHat)->shouldBeCalled();
        $productBundleSlotTopHats->addProduct($smurfHat)->shouldBeCalled();

        $productBundleSlotShirts->setName($slotNameShirts)->shouldBeCalled();
        $productBundleSlotShirts
            ->setPosition($bundleSlotOptionsShirts->getWrappedObject()->getPosition())
            ->shouldBeCalled();
        $productBundleSlotShirts->setBundle($productBundle)->shouldBeCalled();
        $productBundleSlotShirts->addProduct($whiteShirt)->shouldBeCalled();

        $this
            ->createProductBundle($productBundleName, $smurfOutfit)
            ->addSlot($slotNameHats, $bundleSlotOptionsHats, $productsHats)
            ->addSlot($slotNameShirts, $bundleSlotOptionsShirts, $productsShirts)
        ;
    }

    function it_can_add_a_slot_as_presentation_slot(
        FactoryInterface $productBundleFactory,
        ProductBundleInterface $productBundle,
        FactoryInterface $productBundleSlotFactory,
        ProductBundleSlotInterface $productBundleSlot,
        ProductInterface $smurfOutfit,
        ProductBundleSlotOptionsInterface $bundleSlotOptions
    ) {
        $productBundleName = 'Woolly Smurfs Outfit';
        $slotName = 'Top Hats';

        $bundleSlotOptions->getPosition()->willReturn(1);
        $bundleSlotOptions->isPresentationSlot()->willReturn(true);

        $productBundleFactory->createNew()->shouldBeCalled()->willReturn($productBundle);

        $productBundleSlotFactory->createNew()->shouldBeCalled()->willReturn($productBundleSlot);

        $productBundle->setProduct($smurfOutfit)->shouldBeCalled();
        $productBundle->addSlot($productBundleSlot)->shouldBeCalled();
        $productBundle->setPresentationSlot($productBundleSlot)->shouldBeCalled();
        $productBundle->setName($productBundleName)->shouldBeCalled();

        $productBundleSlot->setName($slotName)->shouldBeCalled();
        $productBundleSlot->setBundle($productBundle)->shouldBeCalled();
        $productBundleSlot->setPosition($bundleSlotOptions->getWrappedObject()->getPosition())->shouldBeCalled();

        $this
            ->createProductBundle($productBundleName, $smurfOutfit)
            ->addSlot($slotName, $bundleSlotOptions)
        ;
    }
}
