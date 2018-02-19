<?php
declare(strict_types=1);

namespace SolutionDrive\SyliusProductBundlesPlugin\Service;

use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use SolutionDrive\SyliusProductBundlesPlugin\Exception\ProductIsNotAProductBundleException;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Created by solutionDrive GmbH.
 *
 * @copyright 2018 solutionDrive GmbH
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
        return (null !== $productBundle);
    }

    public function getProductBundleForProduct(ProductInterface $product): ProductBundleInterface
    {
        $productBundle = $this->productBundleRepository->findOneBy(['product' => $product]);
        if (null === $productBundle) {
            throw new ProductIsNotAProductBundleException($product);
        }
        return $productBundle;
    }
}
