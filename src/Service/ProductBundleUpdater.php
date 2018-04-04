<?php

declare(strict_types=1);

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;

class ProductBundleUpdater implements ProductBundleUpdaterInterface
{
    /**
     * {@inheritdoc}
     */
    public function addMissingSlotsToBundle(ProductBundleInterface $productBundle, array $allProductsPerSlot): void
    {
        // TODO: Implement addMissingSlotsToBundle() method.
    }
}
