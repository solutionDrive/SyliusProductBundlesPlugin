<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace spec\solutionDrive\SyliusProductBundlesPlugin\Service;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactoryInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleManipulatorInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleUpdater;
use solutionDrive\SyliusProductBundlesPlugin\Service\ProductBundleUpdaterInterface;
use Sylius\Component\Core\Model\ProductInterface;

class ProductBundleUpdaterSpec extends ObjectBehavior
{
    public function let(
        ProductBundleSlotOptionsFactoryInterface $bundleSlotOptionsFactory,
        ProductBundleManipulatorInterface $productBundleManipulator
    ): void {
        $this->beConstructedWith($bundleSlotOptionsFactory, $productBundleManipulator);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductBundleUpdater::class);
    }

    public function it_implements_the_product_bundle_updater_interface(): void
    {
        $this->shouldImplement(ProductBundleUpdaterInterface::class);
    }

    public function it_adds_missing_slots_to_the_bundle(
        ProductBundleInterface $productBundle,
        ProductBundleSlotInterface $shirtSlot,
        ProductBundleSlotInterface $shortSlot,
        ProductBundleSlotOptionsFactoryInterface $bundleSlotOptionsFactory,
        ProductBundleSlotOptionsInterface $slotOptionsSocks,
        ProductInterface $redShort,
        ProductInterface $blueShort,
        ProductInterface $redShirt,
        ProductInterface $blueSocks,
        ProductBundleManipulatorInterface $productBundleManipulator
    ): void {
        $shortSlot->getName()->willReturn('Shorts');
        $shirtSlot->getName()->willReturn('Shirt');

        $allProductsPerSlot = [
            'Shirt' => [
                $redShirt,
            ],
            'Shorts' => [
                $blueShort,
                $redShort,
            ],
            'Socks' => [
                $blueSocks,
            ],
        ];

        $productBundleSlotsConfiguration = [
            'Socks' => $slotOptionsSocks->getWrappedObject(),
        ];

        $bundleSlotOptionsFactory->createNewWithValues(3, false)->willReturn($slotOptionsSocks);

        $collectionOfInitialAssignedSlots
            = new ArrayCollection(
                [
                    $shirtSlot->getWrappedObject(),
                    $shortSlot->getWrappedObject(),
                ]
            );
        $productBundle->getSlots()->willReturn($collectionOfInitialAssignedSlots)->shouldBeCalled();

        $productBundleManipulator->setProductBundle($productBundle)->shouldBeCalled();
        $productBundleManipulator->addSlot('Socks', $slotOptionsSocks, [$blueSocks])->shouldBeCalled();

        $this->addMissingSlotsToBundle($productBundle, $allProductsPerSlot, $productBundleSlotsConfiguration);
    }
}
