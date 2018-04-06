<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlotInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundleManipulator implements ProductBundleManipulatorInterface
{
    /** @var FactoryInterface */
    private $productBundleSlotFactory;

    /** @var ProductBundleInterface */
    private $productBundle;

    public function __construct(FactoryInterface $productBundleSlotFactory)
    {
        $this->productBundleSlotFactory = $productBundleSlotFactory;
    }

    public function setProductBundle(ProductBundleInterface $productBundle): void
    {
        $this->productBundle = $productBundle;
    }

    public function getProductBundle(): ?ProductBundleInterface
    {
        return $this->productBundle;
    }

    /**
     * @param ProductInterface[] $products
     */
    public function addSlot(
        string $slotName,
        ProductBundleSlotOptionsInterface $options = null,
        array $products = []
    ): void {
        $slot = $this->createSlot($slotName);
        $this->applyOptionsToSlot($options, $slot);
        $this->addProductsToSlot($products, $slot);
        $this->addSlotToBundle($slot);
    }

    private function createSlot(string $slotName): ProductBundleSlotInterface
    {
        /** @var ProductBundleSlotInterface $slot */
        $slot = $this->productBundleSlotFactory->createNew();
        $slot->setName($slotName);

        return $slot;
    }

    private function applyOptionsToSlot(
        ?ProductBundleSlotOptionsInterface $options,
        ProductBundleSlotInterface $slot
    ): void {
        if ($this->hasPositionOption($options)) {
            $slot->setPosition($options->getPosition());
        }
        if ($this->shouldSetAsPresentationSlot($options)) {
            $this->setPresentationSlotOnBundle($slot);
        }
    }

    private function addSlotToBundle(ProductBundleSlotInterface $slot): void
    {
        $this->productBundle->addSlot($slot);
    }

    private function setPresentationSlotOnBundle(ProductBundleSlotInterface $slot): void
    {
        $this->productBundle->setPresentationSlot($slot);
    }

    /**
     * @param ProductInterface[] $products
     */
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

    private function hasPositionOption(?ProductBundleSlotOptionsInterface $options): bool
    {
        return null !== $options && null !== $options->getPosition();
    }

    private function shouldSetAsPresentationSlot(?ProductBundleSlotOptionsInterface $options): bool
    {
        return null !== $options && $options->isPresentationSlot();
    }
}
