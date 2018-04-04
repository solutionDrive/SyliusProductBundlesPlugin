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

class ProductBundleCreator implements ProductBundleCreatorInterface
{
    /** @var FactoryInterface */
    private $productBundleFactory;

    /** @var FactoryInterface */
    private $productBundleSlotFactory;

    /** @var ProductBundleManipulatorInterface */
    private $productBundleManipulator;

    public function __construct(
        FactoryInterface $productBundleFactory,
        ProductBundleManipulatorInterface $productBundleManipulator
    ) {
        $this->productBundleFactory = $productBundleFactory;
        $this->productBundleManipulator = $productBundleManipulator;
    }

    public function createProductBundle(ProductInterface $productBundleProduct): void
    {
        /** @var ProductBundleInterface $productBundle */
        $productBundle = $this->productBundleFactory->createNew();
        $productBundle->setProduct($productBundleProduct);
        $this->productBundleManipulator->setProductBundle($productBundle);
    }

    public function getProductBundle(): ProductBundleInterface
    {
        return $this->productBundleManipulator->getProductBundle();
    }

    /**
     * {@inheritdoc}
     */
    public function addSlot(
        string $slotName,
        ?ProductBundleSlotOptionsInterface $options = null,
        array $products = []
    ): void {
        $this->productBundleManipulator->addSlot($slotName, $options, $products);
    }
}
