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

    /**
     * ManagingProductBundlesContext constructor.
     * @param IndexPage $indexPage
     * @param CreatePage $createPage
     * @param UpdatePage $updatePage
     */
    public function __construct(IndexPage $indexPage, CreatePage $createPage, UpdatePage $updatePage)
    {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
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
     * @Then I should see a product bundle :productBundleName
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
}
