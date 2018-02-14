<?php
/**
 * Created by solutionDrive GmbH.
 *
 * @author:    Tobias Lückel <lueckel@solutionDrive.de>
 * @date:      03.02.18
 * @time:      12:14
 * @copyright: 2018 solutionDrive GmbH
 */
declare(strict_types=1);

namespace Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Behat\Service\SharedStorage;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class ProductBundlesSetupContext implements Context
{
    /** @var SharedStorage */
    private $sharedStorage;

    /** @var FactoryInterface */
    private $productBundleFactory;

    /** @var EntityManagerInterface */
    private $productBundleManager;

    /**
     * @param SharedStorage $sharedStorage
     */
    public function __construct(
        SharedStorage $sharedStorage,
        FactoryInterface $productBundleFactory,
        EntityManagerInterface $productBundleManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->productBundleFactory = $productBundleFactory;
        $this->productBundleManager = $productBundleManager;
    }

    /**
     * @Given the store has a product bundle :name
     */
    public function theStoreHasAProductBundle(string $name): void
    {
        $productBundle = $this->productBundleFactory->createNew();
        $productBundle->setName($name);
        $productBundle->setCode($name);

        $this->productBundleManager->persist($productBundle);
        $this->productBundleManager->flush();

        $this->sharedStorage->set('product_bundle', $productBundle);
    }

    /**
     * @todo not yet implemented
     * @Given /^this product bundle contains "([^"]*)"$/
     */
    public function thisProductBundleContains($arg1)
    {
    }

    /**
     * @Given /^(this product) is a product bundle product$/
     */
    public function thisProductIsAProductBundleProduct(ProductInterface $product)
    {
        /**
         * @todo ensure injected product can be identified as product-bundle
         */
        throw new PendingException();
    }
}
