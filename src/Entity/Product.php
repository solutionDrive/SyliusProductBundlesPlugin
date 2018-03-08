<?php

declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct
{
    /** @var ProductBundleInterface */
    private $productBundle;

    public function setProductBundle(ProductBundleInterface $productBundle)
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
