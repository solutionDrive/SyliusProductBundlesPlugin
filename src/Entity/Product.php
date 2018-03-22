<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\SyliusProductBundlesPlugin\Entity;

use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct
{
    /** @var ProductBundleInterface */
    private $productBundle;

    public function setProductBundle(ProductBundleInterface $productBundle): void
    {
        $this->productBundle = $productBundle;
    }

    public function getProductBundle(): ?ProductBundleInterface
    {
        return $this->productBundle;
    }

    public function getProductBundleId(): ?int
    {
        if (null === $this->productBundle) {
            return null;
        }

        return $this->productBundle->getId();
    }
}
