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

    public function setProductBundle(ProductBundleInterface $productBundle): void
    {
        $this->productBundleManipulator->setProductBundle($productBundle);
    }

    public function getProductBundle(): ?ProductBundleInterface
    {
        return $this->productBundleManipulator->getProductBundle();
    }

    /**
     * {@inheritdoc}
     */
    public function addMissingSlotsToBundle(ProductBundleInterface $productBundle, array $allProductsPerSlot): void
    {

        // @todo maybe we should call the setter here and make the setter private?
        // @todo is there a use case for the getter since the bundle comes from the outside and could only be returned to the caller anyway and he should have the bundle already
        $existingSlots = $this->getExistingSlotNames($productBundle);
        foreach ($allProductsPerSlot as $slotName => $slotContent) {
            if ($this->slotAlreadyExists($slotName, $existingSlots)) {
                continue;
            }
            //@todo find a way to set a configured sort-value
            $slotOptions = $this->bundleSlotOptionsFactory->createNewWithValues(99, false);
            $this->productBundleManipulator->addSlot($slotName, $slotOptions, $slotContent);
        }
    }

    /**
     * @return string[]
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
}
