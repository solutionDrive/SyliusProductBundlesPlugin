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

namespace Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Context;

use Behat\Behat\Context\Context;
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
}
