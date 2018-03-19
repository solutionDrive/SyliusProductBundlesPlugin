<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use Behat\Mink\Driver\Selenium2Driver;
use Sylius\Behat\Page\Admin\Crud\CreatePage as CrudCreatePage;
use Webmozart\Assert\Assert;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
final class CreatePage extends CrudCreatePage
{

    public function specifyProductBundleProduct(string $productCode)
    {
        Assert::isInstanceOf($this->getDriver(), Selenium2Driver::class);
        $dropdown = $this->getDocument()->find('css', '#product_bundle_product')->getParent();

        Assert::notNull($dropdown);
        $dropdown->click();
        $dropdown->waitFor(5, function () use ($productCode, $dropdown) {
            return $dropdown->has('css', '.item[data-value="' . $productCode . '"]');
        });

        $item = $dropdown->find('css', '.item[data-value="' . $productCode . '"]');
        $item->click();
    }
}
