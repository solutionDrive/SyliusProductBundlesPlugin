<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundleCreator implements ProductBundleCreatorInterface
{
    /** @var FactoryInterface */
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

    public function createProductBundle(string $productBundleName, ProductInterface $productBundleProduct): self
    {
        $this->productBundle = $this->productBundleFactory->createNew();
        $this->productBundle->setName($productBundleName);
        $this->productBundle->setProduct($productBundleProduct);

        return $this;
    }

    public function getProductBundle(): ProductBundleInterface
    {
        return $this->productBundle;
    }

    public function addSlot(string $slotName, array $options = [], array $products = []): self
    {
        /** @var ProductBundleSlotInterface $slot */
        $slot = $this->createSlot($slotName);

        $this->applyOptionsToSlot($options, $slot);
        $this->addProductsToSlot($products, $slot);
        $this->addSlotToBundle($options, $slot);

        return $this;
    }

    private function applyOptionsToSlot(array $options, ProductBundleSlotInterface $slot): void
    {
        if (isset($options['position'])) {
            $slot->setPosition($options['position']);
        }
    }

    private function addProductsToSlot(array $products, ProductBundleSlotInterface $slot): void
    {
        foreach ($products as $product) {
            $this->addProductToSlot($product, $slot);
        }
    }

    private function addProductToSlot(ProductInterface $product, ProductBundleSlotInterface $slot): void
    {
        $slot->addProduct($product);
    }

    private function addSlotToBundle(array $options, $slot): void
    {
        if (isset($options['isPresentation']) && $options['isPresentation'] === true) {
            $this->productBundle->setPresentationSlot($slot);
        }
        $this->productBundle->addSlot($slot);
    }

    private function createSlot(string $slotName): ProductBundleSlotInterface
    {
        /** @var ProductBundleSlotInterface $slot */
        $slot = $this->productBundleSlotFactory->createNew();
        $slot->setName($slotName);
        $slot->setBundle($this->productBundle);

        return $slot;
    }
}
