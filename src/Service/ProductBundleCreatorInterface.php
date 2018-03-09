<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
interface ProductBundleCreatorInterface
{
    public function createProductBundle(
        string $productBundleName,
        ProductInterface $productBundleProduct
    ): ProductBundleCreator;

    public function getProductBundle(): ProductBundleInterface;

    public function addSlot(string $slotName, array $options = [], array $products = []): ProductBundleCreator;
}
