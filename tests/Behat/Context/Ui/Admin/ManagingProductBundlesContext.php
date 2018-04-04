<?php

declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use SolutionDrive\SyliusProductBundlesPlugin\Entity\ProductBundleInterface;
use Sylius\Component\Core\Model\ProductInterface;
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

    /**
     * @param IndexPage  $indexPage
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
    public function iShouldSeeAProductBundle(string $productBundleName): void
    {
        Assert::true(
            $this
                ->indexPage
                ->isSingleResourceOnPage(['product.name' => $productBundleName])
        );
    }

    /**
     * @When I create a new product bundle
     * @When I try to create a new product bundle
     */
    public function iCreateANewProductBundle(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I add it
     * @When I try to add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @When /^I associate the (product "[^"]+") with its bundle$/
     */
    public function iAssociateTheProductWithItsBundle(ProductInterface $product): void
    {
        $this->createPage->specifyProductBundleProduct($product->getCode());
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
    public function iShouldNotSeeAProductBundle(string $productBundle): void
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
     * @When I add an empty slot
     */
    public function iAddTheSlot(string $slotName = ''): void
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
        Assert::keyExists($this->updatePage->getSlotSubForms(), $slotName);
    }

    /**
     * @When /^I add the (product "[^"]+") to the slot "([^"]+)"$/
     */
    public function iAddTheProductToTheSlot(ProductInterface $product, string $slotName): void
    {
        $this->updatePage->associateSlotWithProducts($slotName, [$product->getCode()]);
    }

    /**
     * @Then /^I should see the product bundle has a slot named "([^"]+)" with the ("[^"]+" product)^
     */
    public function iShouldSeeTheProductBundleHasASlotNamedWithTheProduct(string $slotName, ProductInterface $product): void
    {
        $this->updatePage->hasSlotWithProduct($slotName, $product->getCode());
    }

    /**
     * @When I remove the slot named :slotName
     */
    public function iRemoveTheSlotNamed(string $slotName): void
    {
        $this->updatePage->removeSlot($slotName);
    }

    /**
     * @Then I should see the product bundle has no slot named :slotName
     */
    public function iShouldSeeTheProductBundleHasNoSlotNamed(string $slotName): void
    {
        Assert::keyNotExists($this->updatePage->getSlotSubForms(), $slotName);
    }

    /**
     * @Then I should be notified that :element is required
     */
    public function iShouldBeNotifiedThatElementIsRequired(string $element): void
    {
        Assert::same($this->updatePage->getValidationMessage($element), 'This value should not be blank.');
    }

    /**
     * @Then I should be notified that a product has to be defined
     */
    public function iShouldBeNotifiedThatAProductHasToBeDefined(): void
    {
        Assert::same($this->createPage->getValidationMessage('product'), 'This value should not be blank.');
    }

    /**
     * @When I specify the slot :slot as presentation slot
     */
    public function iSpecifyTheSlotAsPresentationSlot(string $slot)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see that the ("[^"]+" product bundle) has the presentation slot "([^"]+)"$/
     */
    public function iShouldSeeThatTheProductBundleHasThePresentationSlot(ProductBundleInterface $productBundle, string $slot)
    {
        throw new PendingException();
    }
}
