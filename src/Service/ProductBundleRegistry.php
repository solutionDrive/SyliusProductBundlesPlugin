<?php

declare(strict_types=1);

namespace solutionDrive\SyliusProductBundlesPlugin\Service;

use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Exception\ProductIsNotAProductBundleException;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
 *
 * @todo check if this class is still necessary / brings benefit when we extend the product Entity
 */
class ProductBundleRegistry implements ProductBundleRegistryInterface
{
    /** @var RepositoryInterface */
    private $productBundleRepository;

    public function __construct(RepositoryInterface $productBundleRepository)
    {
        $this->productBundleRepository = $productBundleRepository;
    }

    public function isProductBundle(ProductInterface $product): bool
    {
        $productBundle = $this->productBundleRepository->findOneBy(['product' => $product]);

        return null !== $productBundle;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductBundleForProduct(ProductInterface $product): ProductBundleInterface
    {
        /** @var ProductBundleInterface $productBundle */
        $productBundle = $this->productBundleRepository->findOneBy(['product' => $product]);
        if ($productBundle instanceof ProductBundleInterface === false) {
            throw new ProductIsNotAProductBundleException($product);
        }

        return $productBundle;
    }
}
