<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Service\Options\ProductBundleSlotOptionsInterface;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductBundleCreatorInterface
{
    public function createProductBundle(ProductInterface $productBundleProduct): void;

    public function getProductBundle(): ?ProductBundleInterface;

    /**
     * @param mixed[] $products
     */
    public function addSlot(
        string $slotName,
        ?ProductBundleSlotOptionsInterface $options = null,
        array $products = []
    ): void;
}
