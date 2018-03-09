<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductBundleRegistryInterface
{
    public function isProductBundle(ProductInterface $product): bool;

    /**
     * @param ProductInterface $product
     *
     * @return ProductBundleInterface
     */
    public function getProductBundleForProduct(ProductInterface $product): ProductBundleInterface;
}
