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

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Doctrine\ORM\EntityManagerInterface;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Behat\Service\SharedStorage;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductBundlesContext implements Context
{
    /** @var SharedStorage */
    private $sharedStorage;

    /** @var FactoryInterface */
    private $productBundleFactory;

    /** @var EntityManagerInterface */
    private $productBundleManager;

    /** @var FactoryInterface */
    private $productFactory;

    /** @var EntityManagerInterface */
    private $productEntityManager;

    /**
     * @param SharedStorage $sharedStorage
     */
    public function __construct(
        SharedStorage $sharedStorage,
        FactoryInterface $productBundleFactory,
        EntityManagerInterface $productBundleManager,
        FactoryInterface $productFactory,
        EntityManagerInterface $productEntityManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->productBundleFactory = $productBundleFactory;
        $this->productBundleManager = $productBundleManager;
        $this->productFactory = $productFactory;
        $this->productEntityManager = $productEntityManager;
    }

    /**
     * @Given the store has( also) a product bundle :productBundle
     */
    public function theStoreHasAProductBundle($productBundle): void
    {
        /** @var ProductInterface $product */
        $product = $this->productFactory->createNew();
        $product->setName($productBundle);
        $product->setCode(strtoupper($productBundle));
        $product->setSlug(strtolower($productBundle));
        $this->productEntityManager->persist($product);
        $this->productEntityManager->flush();

        /** @var ProductBundleInterface|ResourceInterface $productBundle */
        $productBundle = $this->productBundleFactory->createNew();
        $productBundle->setProduct($product);
        $this->productBundleManager->persist($productBundle);
        $this->productBundleManager->flush();
        $this->sharedStorage->set('product_bundle', $productBundle);
    }

    /**
     * @Given /^(this product bundle) has(?:| also) a slot named "([^"]*)"$/
     */
    public function thisProductBundleHasASlotNamed(ProductBundleInterface $productBundle, $slot): void
    {
        /**
         * @todo add a slot the the injected $projectBundle with the name in $slot
         */
        throw new PendingException();
    }

    /**
     * @Given /^(this product) is assigned to the slot "([^"]*)" of (this product bundle)$/
     */
    public function thisProductIsAssignedToTheSlotOfThisProductBundle(
        ProductInterface $product,
        $slot,
        ProductBundleInterface $productBundle
    ): void {
        /**
         * @todo add the injected product to the slot named $slot of the injected product bundle
         */
        throw new PendingException();
    }
}
