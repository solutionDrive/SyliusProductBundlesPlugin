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
        $productCodeItemLocator = '.item[data-value="' . $productCode . '"]';
        $this->getElement('product')->click();
        $this->getElement('product')->waitFor(10, function () use ($productCodeItemLocator) {
            return $this->getElement('product')->has('css', $productCodeItemLocator);
        });

        $this->getElement('product')
            ->find('css', $productCodeItemLocator)
            ->click();
    }

    protected function getDefinedElements(): array
    {
        return [
            'product' => '.field > label:contains("Product") ~ .sylius-autocomplete'
        ];
    }
}
