<?php

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleCreator
{
    /** @var FactoryInterface  */
    private $productBundleFactory;

    /** @var FactoryInterface */
    private $productBundleSlotFactory;

    /** @var ProductBundleInterface */
    private $productBundle;

    public function __construct(
        FactoryInterface $productBundleFactory,
        FactoryInterface $productBundleSlotFactory
    ) {
        $this->productBundleFactory = $productBundleFactory;
        $this->productBundleSlotFactory = $productBundleSlotFactory;
    }

    public function createProductBundle(): ProductBundleCreator
    {
        $this->productBundle = $this->productBundleFactory->createNew();
        return $this;
    }

    public function getProductBundle(): ProductBundleInterface
    {
        return $this->productBundle;
    }

    public function addSlot(string $slotName): ProductBundleCreator
    {
        /** @var ProductBundleSlotInterface $slot */
        $slot = $this->productBundleSlotFactory->createNew();
        $slot->setName($slotName);
        $slot->setBundle($this->productBundle);
        $this->productBundle->addSlot($slot);
        return $this;
    }
}
