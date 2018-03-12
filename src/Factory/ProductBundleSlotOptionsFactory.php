<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptions;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;

class ProductBundleSlotOptionsFactory implements ProductBundleSlotOptionsFactoryInterface
{
    public function createNew(): ProductBundleSlotOptionsInterface
    {
        return new ProductBundleSlotOptions();
    }

    public function createNewWithValues(
        int $position,
        bool $isPresentationSlot = false
    ): ProductBundleSlotOptionsInterface
    {
        $productBundleSlotOptions = $this->createNew();
        $productBundleSlotOptions->setPosition($position);
        if($isPresentationSlot) {
            $productBundleSlotOptions->isPresentationSlot();
        }
        return $productBundleSlotOptions;
    }
}
