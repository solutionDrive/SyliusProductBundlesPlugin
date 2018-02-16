<?php
/**
 * Created by solutionDrive GmbH
 *
 * @author    Matthias Alt <alt@solutionDrive.de>
 * date      14.02.18
 * @copyright 2018 solutionDrive GmbH
 */
declare(strict_types=1);

namespace Tests\SolutionDrive\SyliusProductBundlesPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Sylius\Component\Core\Model\ProductInterface;

class ManagingProductBundleProductsContext implements Context
{
    /**
     * @Given /^(this product) should be a product bundle product$/
     */
    public function thisProductShouldBeAProductBundleProduct(ProductInterface $product)
    {
        /**
         * @todo test for product bundle product
         */
        throw new PendingException();
    }
}