<?php
/**
 * Created by solutionDrive GmbH.
 *
 * @author:    Tobias Lückel <lueckel@solutionDrive.de>
 * @date:      03.02.18
 * @time:      12:10
 * @copyright: 2018 solutionDrive GmbH
 */
declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\CreatePage;
use Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\IndexPage;
use Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\UpdatePage;
use Webmozart\Assert\Assert;

class ManagingProductBundlesContext implements Context
{
    /** @var IndexPage */
    private $indexPage;

    /** @var CreatePage */
    private $createPage;

    /** @var UpdatePage */
    private $updatePage;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * @param IndexPage $indexPage
     * @param CreatePage $createPage
     * @param UpdatePage $updatePage
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        IndexPage $indexPage,
        CreatePage $createPage,
        UpdatePage $updatePage,
        ProductRepositoryInterface $productRepository
    ) {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
        $this->productRepository = $productRepository;
    }

    /**
     * @Then I should see :number product bundle(s) in the list
     */
    public function iWantToSeeProductBundleInTheStore(int $number): void
    {
        $this->indexPage->open();
        Assert::same($this->indexPage->countItems(), $number);
    }

    /**
     * @Then I should( still) see a product bundle :productBundleName
     */
    public function iShouldSeeAProductBundle($productBundleName): void
    {
        Assert::true(
            $this
                ->indexPage
                ->isSingleResourceOnPage(['product.name' => $productBundleName])
        );
    }

    /**
     * @When I create a new product bundle
     */
    public function iCreateANewProductBundle(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @When I associate the product :productName with its bundle
     */
    public function iAssociateTheProductWithItsBundle($productName): void
    {
        $products = $this->productRepository->findByName($productName, 'en_US');
        Assert::count($products, 1);
        if (count($products) > 0) {
            $product = array_pop($products);
            $this->createPage->specifyProductName($product->getName());
        }
    }

    /**
     * @When I browse product bundles
     */
    public function iBrowseProductBundles(): void
    {
        $this->indexPage->open();
    }

    /**
     * @When /^I delete (this product bundle)$/
     */
    public function iDeleteThisProductBundle(ProductBundleInterface $productBundle): void
    {
        $this->indexPage->deleteResourceOnPage(['product.code' => $productBundle->getProduct()->getCode()]);
    }

    /**
     * @Then I should not see a product bundle :productBundle
     */
    public function iShouldNotSeeAProductBundle($productBundle): void
    {
        Assert::false(
            $this
                ->indexPage
                ->isSingleResourceOnPage(['product.name' => $productBundle])
        );
    }

    /**
     * @When /^I want to modify the ("[^"]+" product bundle)( again)?$/
     */
    public function iWantToModifyTheProductBundle(ProductBundleInterface $productBundle): void
    {
        $this->updatePage->open(['id' => $productBundle->getId()]);
    }

    /**
     * @When I add the slot :slotName
     */
    public function iAddTheSlot(string $slotName): void
    {
        $this->updatePage->addSlot($slotName);
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @Then I should see the product bundle has a slot named :slotName
     */
    public function iShouldSeeTheProductBundleHasTheSlot(string $slotName): void
    {
        Assert::same($this->updatePage->getFirstSlotName(), $slotName);
    }

    /**
     * @When /^I add the (product "[^"]+") to the slot ("[^"]+")$/
     */
    public function iAddTheProductToTheSlot(ProductInterface $product, string $slotName)
    {
        throw new PendingException();
    }
}
