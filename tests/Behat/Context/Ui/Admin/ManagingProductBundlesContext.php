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

namespace Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\CreatePage;
use Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\IndexPage;
use Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles\UpdatePage;
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
     * ManagingProductBundlesContext constructor.
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
     * @When I want to see :number product bundle(s) in the store
     */
    public function iWantToSeeProductBundleInTheStore(int $number)
    {
        $this->indexPage->open();
        Assert::same($this->indexPage->countItems(), $number);
    }

    /**
     * @Then I should( still) see a product bundle :productBundleName
     */
    public function iShouldSeeAProductBundle($productBundleName)
    {
        Assert::true(
            $this
                ->indexPage
                ->isSingleResourceOnPage(['name' => $productBundleName])
        );
    }

    /**
     * @Given /^I want to modify the "([^"]*)" product bundle$/
     */
    public function iWantToModifyTheProductBundle($productBundle)
    {
        throw new PendingException();
    }

    /**
     * @When /^I add the ("[^"]*" product) to the "([^"]*)" slot of (this product bundle)$/
     */
    public function iAddTheProductToTheSlotOfThisProductBundle(
        ProductInterface $product,
        $slot,
        ProductBundleInterface $productBundle
    ) {
        throw new PendingException();
    }

    /**
     * @Then /^I should see that the "([^"]*)" product is added to the "([^"]*)" slot$/
     */
    public function iShouldSeeThatTheProductIsAddedToTheSlot(string $product, string $slot)
    {
        throw new PendingException();
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see that the (products "[^"]*" and "[^"]*") are assigned to the "([^"]*)" slot of (this product bundle)$/
     */
    public function iShouldSeeThatTheProductsAndAreAssignedToTheSlot(
        array $products,
        $slot,
        ProductBundleInterface $productBundle
    ) {
        throw new PendingException();
    }

    /**
     * @When I create a new product bundle
     */
    public function iCreateANewProductBundle()
    {
        $this->createPage->open();
    }

    /**
     * @When I specify its name as :name
     * @When I remove its name
     */
    public function iSpecifyItsNameAs($name = null)
    {
        $this->createPage->nameIt($name);
    }

    /**
     * @When I add it
     */
    public function iAddIt()
    {
        $this->createPage->create();
    }

    /**
     * @When I am browsing products
     */
    public function iAmBrowsingProducts()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a product with name :arg1
     */
    public function iShouldSeeAProductWithName($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I specify its code as :code
     */
    public function iSpecifyItsCodeAs($code)
    {
        $this->createPage->specifyCode($code);
    }


    /**
     * @When I associate the product :productName with its bundle
     */
    public function iAssociateTheProductWithItsBundle($productName)
    {
        $products = $this->productRepository->findByName($productName, 'en_US');
        Assert::count($products, 1);
        if (count($products) > 0) {
            $product = array_pop($products);
            $this->createPage->specifyProductId($product->getId());
        }
    }

    /**
     * @When I browse product bundles
     */
    public function iBrowseProductBundles()
    {
        $this->indexPage->open();
    }

    /**
     * @When /^I delete (this product bundle)$/
     */
    public function iDeleteThisProductBundle(ProductBundleInterface $productBundle)
    {
        $this->indexPage->deleteResourceOnPage(['code' => $productBundle->getCode()]);
    }

    /**
     * @Then I should not see a product bundle :productBundle
     */
    public function iShouldNotSeeAProductBundle($productBundle)
    {
        Assert::false(
            $this
                ->indexPage
                ->isSingleResourceOnPage(['name' => $productBundle])
        );
    }
}
