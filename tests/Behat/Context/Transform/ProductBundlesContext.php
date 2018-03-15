<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Repository\ProductBundleRepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundlesContext implements Context
{
    /** @var ProductBundleRepositoryInterface */
    private $productBundleRepository;

    /**
     * @param ProductBundleRepositoryInterface $productBundleRepository
     */
    public function __construct(ProductBundleRepositoryInterface $productBundleRepository)
    {
        $this->productBundleRepository = $productBundleRepository;
    }

    /**
     * @Transform /^product bundle(?:|s) "([^"]+)"$/
     * @Transform /^"([^"]+)" product bundle(?:|s)$/
     * @Transform :product bundle
     */
    public function getProductBundleByName(string $productBundleName)
    {
        /** @var ProductBundleInterface[] $productsBundles */
        $productsBundles = $this->productBundleRepository->findByName($productBundleName, 'en_US');

        Assert::eq(
            count($productsBundles),
            1,
            sprintf('%d products has been found with name "%s".', count($productsBundles), $productBundleName)
        );

        return $productsBundles[0];
    }
}
