<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Doctrine\ORM\EntityManagerInterface;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use solutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleSlot;
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

    /** @var FactoryInterface */
    private $productBundleSlotFactory;

    /** @var EntityManagerInterface */
    private $productEntityManager;

    public function __construct(
        SharedStorage $sharedStorage,
        FactoryInterface $productBundleFactory,
        EntityManagerInterface $productBundleManager,
        FactoryInterface $productFactory,
        FactoryInterface $productBundleSlotFactory,
        EntityManagerInterface $productEntityManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->productBundleFactory = $productBundleFactory;
        $this->productBundleManager = $productBundleManager;
        $this->productFactory = $productFactory;
        $this->productBundleSlotFactory = $productBundleSlotFactory;
        $this->productEntityManager = $productEntityManager;
    }

    /**
     * @Given the store has( also) a product bundle :productBundle
     */
    public function theStoreHasAProductBundle(string $productBundle): void
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
     * @Given /^(this product bundle) has(?:| also) a slot named "([^"]*)" with the ("[^"]+" product)$/
     */
    public function thisProductBundleHasASlotNamedWithTheProduct(
        ProductBundleInterface $productBundle,
        string $slotName,
        ?ProductInterface $product
    ): void {
        /** @var ProductBundleSlot $slot */
        $slot = $this->productBundleSlotFactory->createNew();
        $slot->setBundle($productBundle);
        $slot->setName($slotName);
        $slot->addProduct($product);
        $productBundle->getSlots()->add($slot);

        $this->productBundleManager->flush();
    }

    /**
     * @Given /^(this product) is assigned to the slot "([^"]*)" of (this product bundle)$/
     */
    public function thisProductIsAssignedToTheSlotOfThisProductBundle(
        ProductInterface $product,
        string $slot,
        ProductBundleInterface $productBundle
    ): void {
        /*
         * @todo add the injected product to the slot named $slot of the injected product bundle
         */
        throw new PendingException();
    }
}
