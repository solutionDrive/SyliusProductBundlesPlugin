<?php

declare(strict_types=1);

namespace Tests\SolutionDrive\SyliusExamplePlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class ProductBundlesContext implements Context
{
    /** @var RepositoryInterface */
    private $productBundleRepository;

    /**
     * @param $productBundleRepository
     */
    public function __construct(RepositoryInterface $productBundleRepository)
    {
        $this->productBundleRepository = $productBundleRepository;
    }

    /**
     * @Transform /^product bundle(?:|s) "([^"]+)"$/
     * @Transform /^"([^"]+)" product bundle(?:|s)$/
     * @Transform :product bundle
     */
    public function getProductByName($productBundleName)
    {
        $productBundles = $this->productBundleRepository->findBy(['name' => $productBundleName]);

        Assert::eq(
            count($productBundles),
            1,
            sprintf('%d product bundles have been found with name "%s".', count($productBundles), $productBundleName)
        );

        return $productBundles[0];
    }
}
