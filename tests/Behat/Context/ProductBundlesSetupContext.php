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
use Sylius\Behat\Service\SharedStorage;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProductBundlesSetupContext implements Context
{
    /** @var SharedStorage */
    private $sharedStorage;

    /** @var FactoryInterface */
    private $productBundleFactory;

    /**
     * @param SharedStorage $sharedStorage
     */
    public function __construct(
        SharedStorage $sharedStorage,
        FactoryInterface $productBundleFactory
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->productBundleFactory = $productBundleFactory;
    }

    /**
     * @Given the store has a product bundle :name
     */
    public function theStoreHasAProductBundle(string $name): void
    {
        $productBundle = $this->productBundleFactory->createNew();
        $productBundle->setName($name);

        //@todo persist and flush

        $this->sharedStorage->set('product_bundle', $productBundle);
    }

    /**
     * @todo not yet implemented
     * @Given /^this product bundle contains "([^"]*)"$/
     */
    public function thisProductBundleContains($arg1)
    {
    }
}
