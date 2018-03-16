<?php

declare(strict_types=1);

namespace Tests\solutionDrive\SyliusProductBundlesPlugin\Behat\Page\ProductBundles;

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\UpdatePage as CrudUpdatePage;
use Webmozart\Assert\Assert;

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
class UpdatePage extends CrudUpdatePage
{
    public function addSlot(string $slotName): void
    {
        $this->getDocument()->clickLink('Add slot');
        $this->getDocument()->fillField('Name', $slotName);
    }

    public function getFirstSlotName(): string
    {
        return $this->getDocument()->findField('Name')->getValue();
    }

    public function associateSlotWithProducts(string $slotName, array $productCodes): void
    {
        Assert::isInstanceOf($this->getDriver(), Selenium2Driver::class);
        $slotSubForms = $this->getSlotSubForms();
        Assert::keyExists($slotSubForms, $slotName);
        $slotSubForm = $slotSubForms[$slotName];
        $dropdown = $slotSubForm->find('css','.sylius-autocomplete');
        Assert::notNull($dropdown);
        $dropdown->click();
        foreach ($productCodes as $productCode) {
            $dropdown->waitFor(5, function () use ($productCode, $dropdown) {
                return $dropdown->has('css', '.item[data-value="'.$productCode.'"]');
            });

            $item = $dropdown->find('css', '.item[data-value="'.$productCode.'"]');
            $item->click();
        }
    }

    /**
     * @return NodeElement[]
     */
    public function getSlotSubForms(): array
    {
        $slotSubForms = [];
        $formElements = $this->getDocument()->findAll('css', '[data-qa="slot-form-section"]');

        /** @var NodeElement $element */
        foreach ($formElements as $element) {
            $slotSubForms[$element->findField('Name')->getValue()] = $element;
        }
        return $slotSubForms;
    }
}
