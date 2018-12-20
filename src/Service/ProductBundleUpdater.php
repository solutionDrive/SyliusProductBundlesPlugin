<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Factory\ProductBundleSlotOptionsFactoryInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;

class ProductBundleUpdater implements ProductBundleUpdaterInterface
{
    /** @var ProductBundleSlotOptionsFactoryInterface */
    private $bundleSlotOptionsFactory;

    /** @var ProductBundleManipulatorInterface */
    private $productBundleManipulator;

    public function __construct(
        ProductBundleSlotOptionsFactoryInterface $bundleSlotOptionsFactory,
        ProductBundleManipulatorInterface $productBundleManipulator
    ) {
        $this->bundleSlotOptionsFactory = $bundleSlotOptionsFactory;
        $this->productBundleManipulator = $productBundleManipulator;
    }

    /**
     * {@inheritdoc}
     */
    public function addMissingSlotsToBundle(
        ProductBundleInterface $productBundle,
        array $allProductsPerSlot,
        array $slotOptions
    ): void {
        // @todo look into moving some services from morpheus to here. e.g. ProductBundleSlotOptionsCreator
        $this->productBundleManipulator->setProductBundle($productBundle);
        $existingSlots = $this->getExistingSlotNames($productBundle);

        foreach ($allProductsPerSlot as $slotName => $slotContent) {
            if (false === $this->slotAlreadyExists($slotName, $existingSlots)) {
                $optionsForSlot = $this->getOptionsForSlot($slotOptions, $slotName);

                $this->productBundleManipulator->addSlot($slotName, $optionsForSlot, $slotContent);
            }
        }
    }

    /**
     * @return mixed[]
     */
    private function getExistingSlotNames(ProductBundleInterface $productBundle): array
    {
        $existingSlots = [];
        foreach ($productBundle->getSlots() as $bundleSlot) {
            $existingSlots[] = $bundleSlot->getName();
        }
        return $existingSlots;
    }

    /**
     * @param string[] $existingSlots
     */
    private function slotAlreadyExists(string $slotName, array $existingSlots): bool
    {
        return in_array($slotName, $existingSlots);
    }

    /**
     * @param ProductBundleSlotOptionsInterface[] $slotOptions
     */
    private function getOptionsForSlot(array $slotOptions, string $slotName): ProductBundleSlotOptionsInterface
    {
        if (false === isset($slotOptions[$slotName])) {
            return $this->bundleSlotOptionsFactory->createNewWithValues(99, false);
        }

        return $slotOptions[$slotName];
    }
}
