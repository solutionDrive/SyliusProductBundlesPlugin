<?php
declare(strict_types=1);

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace SolutionDrive\SyliusProductBundlesPlugin\Service;

use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductBundleRegistryInterface
{
    public function isProductBundle(ProductInterface $product): bool;

    public function getProductBundleForProduct(ProductInterface $product): ProductBundleInterface;
}
