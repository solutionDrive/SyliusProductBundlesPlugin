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
use Behat\Behat\Tester\Exception\PendingException;

class ManagingProductBundlesContext implements Context
{

    /**
     * @When /^I want to see all product bundles in the store$/
     */
    public function iWantToSeeAllProductBundlesInTheStore()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see a product bundle "([^"]*)"$/
     */
    public function iShouldSeeAProductBundle($arg1)
    {
        throw new PendingException();
    }
}
