<?php

namespace solutionDrive\SyliusProductBundlesPlugin\Factory;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;

class ProductBundleSlotFactory implements ProductBundleSlotFactoryInterface
{
    public function createNew(): ProductBundleSlotInterface
    {
        return new ProductBundleSlot();
    }
}
