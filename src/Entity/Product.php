<?php

namespace SolutionDrive\SyliusProductBundlesPlugin\Entity;

use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct
{
    /** @var ProductBundleInterface */
    private $productBundle;

    /** @var bool */
    private $createBundle = false;

    public function setProductBundle(ProductBundleInterface $productBundle)
    {
        $this->productBundle = $productBundle;
    }

    public function getProductBundle()
    {
        return $this->productBundle;
    }

    public function setCreateBundle(bool $createBundle)
    {
        $this->createBundle = $createBundle;
    }

    public function getCreateBundle()
    {
        return $this->createBundle;
    }
}
